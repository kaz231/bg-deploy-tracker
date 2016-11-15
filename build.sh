rm -rf vendor

composer install --no-dev --optimize-autoloader
php bin/console cache:clear --env=prod --no-debug
php bin/console assetic:dump --env=prod --no-debug
rm -rf tests
rm web/app_dev.php