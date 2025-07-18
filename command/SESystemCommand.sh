#!/bin/bash
cd Herd/SESystem
php artisan view:clear
php artisan view:cache
php artisan route:clear
php artisan route:cache
php artisan config:clear
php artisan config:cache
php artisan optimize
php artisan optimize:clear
php artisan serve

open -a "Google Chrome" http:://127.0.0.1:8000
