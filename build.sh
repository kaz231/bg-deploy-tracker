rm -rf vendor

composer install --no-dev --optimize-autoloader --no-scripts
composer run-script symfony-prod-scripts
php bin/console cache:clear --env=prod --no-debug
rm -rf tests
rm web/app_dev.php
rm -rf .git