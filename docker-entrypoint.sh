#!/bin/sh
set -e

# If .env doesn't exist, create it from example
if [ ! -f "/var/www/html/.env" ]; then
    if [ -f "/var/www/html/.env.example" ]; then
        cp /var/www/html/.env.example /var/www/html/.env
    elif [ -f "/var/www/html/.env .example" ]; then
        cp "/var/www/html/.env .example" /var/www/html/.env
    fi
fi

# Run composer post-autoload-dump scripts to register services (e.g. Filament)
composer run-script post-autoload-dump

# Generate key if not set in environment or .env
if [ -z "$APP_KEY" ] && ! grep -q "APP_KEY=base64" /var/www/html/.env; then
    php artisan key:generate --force
fi

# Clear and cache configurations
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations automatically during deployment
echo "Running migrations..."
php artisan migrate --force

# Seed database if SEED_DATABASE environment variable is set to true
if [ "$SEED_DATABASE" = "true" ]; then
    echo "Seeding database..."
    php artisan db:seed --force
fi

# Create symbolic link for storage if it doesn't exist
php artisan storage:link --force

# Configure Apache to listen on $PORT dynamically (default to 80 if not set)
PORT_TO_USE=${PORT:-80}
echo "Configuring Apache to listen on port ${PORT_TO_USE}..."
sed -i "s/Listen 80/Listen ${PORT_TO_USE}/g" /etc/apache2/ports.conf
sed -i "s/*:80/*:${PORT_TO_USE}/g" /etc/apache2/sites-available/*.conf

# Disable conflicting MPM modules and enable prefork at runtime
echo "Configuring Apache MPM modules..."
a2dismod mpm_event mpm_worker || true
a2enmod mpm_prefork

# Ensure correct permissions on storage and bootstrap directories at runtime
echo "Fixing permissions for storage and bootstrap/cache..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Start Apache in the foreground
exec apache2-foreground
