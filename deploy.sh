#!/bin/bash

set -e

git pull

composer install --no-interaction --prefer-dist --optimize-autoloader

npm install

npm run build

php artisan optimize:clear

php artisan migrate --force
