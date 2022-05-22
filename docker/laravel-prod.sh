#!/bin/bash

echo "Starting laravel..."

# Access to storage and logs
chown -R www-data:www-data storage

#php artisan migrate --seed
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
php artisan sitemap:generate
php artisan l5-swagger:generate

# Let nginx service static files directly
cp -RT /app/public /yarn-out

exec php-fpm
