# PhpScaffolding

[![MIT Software License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](LICENSE.md)

This is a scaffolding for PHP projects using Docker. In this repository you will find:

* Latest `PHP` (currently [7.4](https://en.wikipedia.org/wiki/PHP#Release_history))
* Latest `PHPUnit` (currently [9](https://phpunit.de/announcements/phpunit-9.html))
* PHP style checker (from [FriendsOfPHP](https://github.com/FriendsOfPHP/PHP-CS-Fixer))
* Psalm static analysis tool (from [Vimeo](https://github.com/vimeo/psalm))
* Basic dockerfile ready to use from your `docker-compose.yml`
* Basic structure to start coding in `src` and `tests`

## Installing dependencies

To set up the container and install the composer dependencies:

```bash
docker-compose up -d
docker-compose exec php_scaffolding composer install
```

You can go inside the docker container:

```bash
docker exec -ti -u dev php_scaffolding bash
```

Check out your code via the web browser creating a development server:

```
docker-compose exec php_scaffolding php -S 0.0.0.0:8080 public/index.php
```

## Composer Scripts

```bash
composer test     # run test-quality and test-unit
composer test-quality # run psalm
composer test-unit    # run phpunit

composer psalm  # run Psalm coverage
composer csfix  # run the code fixer (`.php_cs`)
```
