#!/bin/bash

set -e

git pull

composer install --no-interaction --prefer-dist --optimize-autoloader

npm install

npm run build

mkdir -p storage/framework/views
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p bootstrap/cache

chmod 777 storage
chmod 777 storage/framework
chmod 777 storage/framework/views
chmod 777 storage/framework/sessions
chmod 777 storage/framework/cache
chmod 777 bootstrap/cache

php artisan optimize:clear

php artisan migrate --force
