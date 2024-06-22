#!/bin/sh
set -e

cd /var/www/backend
composer install
php artisan migrate

exec "$@"
