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

# Create symbolic link for storage if it doesn't exist
php artisan storage:link --force

# Start Apache in the foreground
exec apache2-foreground
