#!/bin/bash

set -e

if docker ps | grep -q php_scaffolding; then
    docker-compose exec php_scaffolding composer test-all
fi
