# PhpScaffolding

[![MIT Software License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](LICENSE.md)

In this repository you will find:

* Latest `PHP` (currently [8.0](https://en.wikipedia.org/wiki/PHP#Release_history)) <- the language
* Latest `Composer` (currently [2.0](https://getcomposer.org/)) <- the package manager
* Latest `PHPUnit` (currently [9](https://phpunit.de/announcements/phpunit-9.html)) <- the tester 
* Latest `XDebug` (currently [3](https://xdebug.org/docs/)) <- the debugger
* Latest `Psalm` (currently [4](https://github.com/vimeo/psalm)) <- the static analysis tool
* Basic `Dockerfile` ready to use from your `docker-compose.yml` <- the foundation
* Basic structure ready to start coding in `src` and `tests` <- your logic; your design

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

## Some composer scripts

```bash
composer test-all     # run test-quality and test-unit
composer test-quality # run psalm
composer test-unit    # run phpunit

composer psalm  # run Psalm coverage
```

----------

More info about this scaffolding -> https://github.com/Chemaclass/PhpScaffolding
