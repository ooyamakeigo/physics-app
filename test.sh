#!/bin/bash

php artisan config:clear
./vendor/bin/phpunit tests/Feature/OAuthTest.php
