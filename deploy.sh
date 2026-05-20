#!/bin/bash

set -e

git pull

composer install --no-interaction --prefer-dist --optimize-autoloader

npm install

npm run build

mkdir -p storage/framework/{views,cache,sessions}
mkdir -p bootstrap/cache

chmod -R 777 storage
chmod -R 777 bootstrap/cache

php artisan optimize:clear

php artisan migrate --force
