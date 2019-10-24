#!/bin/sh

# Replace entries in config.php with any specified environment variables

[ -n "${DB_HOSTNAME}" ] && sed -i "s/^\$DB_HOSTNAME =.*$/\$DB_HOSTNAME = \"${DB_HOSTNAME}\";/g" /var/www/html/config.php
[ -n "${DB_USERNAME}" ] && sed -i "s/^\$DB_USERNAME =.*$/\$DB_USERNAME = \"${DB_USERNAME}\";/g" /var/www/html/config.php
[ -n "${DB_PASSWORD}" ] && sed -i "s/^\$DB_PASSWORD =.*$/\$DB_PASSWORD = \"${DB_PASSWORD}\";/g" /var/www/html/config.php
[ -n "${DB_DATABASE}" ] && sed -i "s/^\$DB_DATABASE =.*$/\$DB_DATABASE = \"${DB_DATABASE}\";/g" /var/www/html/config.php

exec /usr/sbin/httpd -DFOREGROUND
