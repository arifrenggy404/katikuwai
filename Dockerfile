# Stage 1: Build assets using Node
FROM node:20-alpine AS node-builder
WORKDIR /app
COPY package*.json tailwind.config.js vite.config.js ./
COPY resources/ ./resources/
COPY public/ ./public/
RUN npm ci && npm run build

# Stage 2: PHP & Apache Server
FROM php:8.4-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libicu-dev \
    zip \
    unzip \
    git \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    gd \
    zip \
    intl \
    exif \
    bcmath \
    opcache

# Enable Apache rewrite, deflate, headers, and expires modules
RUN a2enmod rewrite deflate headers expires \
    && (a2dismod mpm_event mpm_worker || true) \
    && a2enmod mpm_prefork

# Configure Apache Document Root to Laravel's public directory
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Configure custom php.ini settings for production
RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 50M/g' "$PHP_INI_DIR/php.ini" \
    && sed -i 's/post_max_size = 8M/post_max_size = 50M/g' "$PHP_INI_DIR/php.ini" \
    && sed -i 's/memory_limit = 128M/memory_limit = 256M/g' "$PHP_INI_DIR/php.ini" \
    && echo "realpath_cache_size = 4096k" >> "$PHP_INI_DIR/php.ini" \
    && echo "realpath_cache_ttl = 600" >> "$PHP_INI_DIR/php.ini"

# Enable OPcache for Laravel performance
RUN docker-php-ext-enable opcache \
    && echo "opcache.enable=1" >> "$PHP_INI_DIR/conf.d/docker-php-ext-opcache.ini" \
    && echo "opcache.enable_cli=1" >> "$PHP_INI_DIR/conf.d/docker-php-ext-opcache.ini" \
    && echo "opcache.memory_consumption=128" >> "$PHP_INI_DIR/conf.d/docker-php-ext-opcache.ini" \
    && echo "opcache.interned_strings_buffer=16" >> "$PHP_INI_DIR/conf.d/docker-php-ext-opcache.ini" \
    && echo "opcache.max_accelerated_files=10000" >> "$PHP_INI_DIR/conf.d/docker-php-ext-opcache.ini" \
    && echo "opcache.revalidate_freq=0" >> "$PHP_INI_DIR/conf.d/docker-php-ext-opcache.ini" \
    && echo "opcache.validate_timestamps=0" >> "$PHP_INI_DIR/conf.d/docker-php-ext-opcache.ini"

# Configure Apache Prefork Worker Limits optimized for RAM constraints
RUN echo "<IfModule mpm_prefork_module>\n\
    StartServers 2\n\
    MinSpareServers 2\n\
    MaxSpareServers 5\n\
    MaxRequestWorkers 50\n\
    MaxConnectionsPerChild 1000\n\
</IfModule>" > /etc/apache2/mods-available/mpm_prefork.conf

# Set working directory
WORKDIR /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy composer manifest first for Docker layer caching
COPY composer.json composer.lock ./

# Install dependencies using Composer
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-autoloader

# Copy remaining project files
COPY . .

# Copy compiled assets from node-builder
COPY --from=node-builder /app/public/build ./public/build

# Dump optimized autoloader
RUN composer dump-autoload --optimize --no-dev --classmap-authoritative

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port
EXPOSE 80

# Copy and set entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]
