#!/bin/bash

echo "Starting laravel..."

# Let nginx service static files directly
cp -RT /app/public /yarn-out

# Access to storage and logs
chown -R www-data:www-data storage

#php artisan migrate --seed
php artisan migrate --force
php artisan config:cache

exec php-fpm
