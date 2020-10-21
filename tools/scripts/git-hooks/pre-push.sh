#!/bin/bash

set -e

if docker ps | grep -q php_scaffolding; then
    docker-compose exec -T php_scaffolding composer test-all
else
    echo "Are you sure Docker is running?"
fi
