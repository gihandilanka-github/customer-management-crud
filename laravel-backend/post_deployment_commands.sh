#!/bin/bash
# ------------------------------------------------------------------
# Dilanka
# ------------------------------------------------------------------

#rm composer.lock
#composer install

php artisan config:cache
php artisan view:clear
php artisan module:optimize
php artisan optimize:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear
composer dump-autoload

php artisan migrate --force
npm i
npm run production

php artisan storage:link
