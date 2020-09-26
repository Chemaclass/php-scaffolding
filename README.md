# PHP Scaffolding

[![MIT Software License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](LICENSE.md)

This is a scaffolding for PHP projects using Docker. In this repository you will find:

* Latest `PHP` (currently [7.4](https://en.wikipedia.org/wiki/PHP#Release_history))
* Latest `PHPUnit` (currently [9](https://phpunit.de/announcements/phpunit-9.html))
* PHP style checker (from [FriendsOfPHP](https://github.com/FriendsOfPHP/PHP-CS-Fixer))
* Psalm static analysis tool (from [Vimeo](https://github.com/vimeo/psalm))
* Basic dockerfile ready to use from your `docker-compose.yml`
* Basic structure to start coding in `src` and `tests`

## Installation

Clone (or fork) this repository
1. Install the dependencies by yourself
2. or modify and use the provided docker container
   1. Modify the [dockerfile](devops/dev/php.dockerfile) in order to adjust the `WORKDIR` to your needs
      * Update the [docker-compose.yml](docker-compose.yml) file (`container_name` and `volumes` values)
   2. Install the dependencies by yourself or build & start the image

To set up the container and install the composer dependencies:

```bash
docker-compose up -d
docker-compose exec php_scaffolding composer install
```

If you want to go inside the docker container:

```bash
docker exec -ti -u dev php_scaffolding bash
```

## Composer Scripts

```bash
composer test         # run test-quality (psalm, infect) and test-unit (phpunit)
composer test-quality # run psalm and infect
composer test-unit    # run phpunit

composer psalm  # run Psalm coverage
composer infect # run Mutation Testing
composer csfix  # run the code fixer (`.php_cs`)
```

## Git hooks

There are some git hooks

* `./tools/scripts/git-hooks/pre-commit.sh`
* `./tools/scripts/git-hooks/pre-push.sh`

In order to create a soft-symlink:

```bash
ln -s tools/scripts/git-hooks/pre-commit.sh .git/hooks/pre-commit
ln -s tools/scripts/git-hooks/pre-push.sh .git/hooks/pre-push
```

## Contributions

Feel free to open any PR with your suggestions or improvements.
