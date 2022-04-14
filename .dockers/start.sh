#!/bin/bash
#composer dump-autoload --no-scripts --optimize
#php artisan optimize
php artisan migrate --force
chmod -R 777 storage/
nginx
/usr/local/sbin/php-fpm -O --nodaemonize