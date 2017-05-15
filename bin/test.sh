#!/bin/bash

set -e 

cd "$(dirname "$0")/../"

export SYMFONY_ENV=test

./bin/reset

./vendor/bin/phpunit --verbose

# ./bin/reset

./vendor/bin/behat

