#!/bin/sh
set -eu

php artisan storage:link --force || true
php artisan migrate --force
php artisan optimize

exec apache2-foreground