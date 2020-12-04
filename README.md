# PHP Scaffolding

[![MIT Software License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](LICENSE.md)

This is a scaffolding for PHP projects using Docker. 

In this repository you will find:

* Latest `PHP` (currently [8.0](https://en.wikipedia.org/wiki/PHP#Release_history)) <- the language
* Latest `Composer` (currently [2.0](https://getcomposer.org/)) <- the package manager
* Latest `PHPUnit` (currently [9](https://phpunit.de/announcements/phpunit-9.html)) <- the tester 
* Latest `XDebug` (currently [3](https://xdebug.org/docs/)) <- the debugger
* Latest `Psalm` (currently [4](https://github.com/vimeo/psalm)) <- the static analysis tool
* Basic `Dockerfile` ready to use from your `docker-compose.yml` <- the foundation
* Basic structure ready to start coding in `src` and `tests` <- your logic; your design

## Custom Installation

### Clone this repository

> git clone https://github.com/Chemaclass/PhpScaffolding YourProjectName

#### Using the installer script to set-up the new project (recommended)

To run the installation script you will need to have a `PHP 7.1+` in your local machine:

> php install.php

Using the installer script `install` (in PHP) it will replace the Project & Container names
to customized values and prepare everything you need to start working in your project.

#### Installing the dependencies manually

To set up the container and install the composer dependencies:

```bash
docker-compose up -d
docker-compose exec your_project_name composer install
```

### Getting the bash from your project

If you want to go inside the docker container:

```bash
docker exec -ti -u dev your_project_name bash
```

## Some composer scripts

```bash
composer test-all     # run test-quality and test-unit
composer test-quality # run psalm
composer test-unit    # run phpunit

composer psalm  # run Psalm coverage
composer csfix  # run the code fixer (`.php_cs`)
```

## Git hooks

There are some git hooks

* `./tools/scripts/git-hooks/pre-commit.sh`
* `./tools/scripts/git-hooks/pre-push.sh`

that they will be linked as soft-symlinks:

```bash
ln -s tools/scripts/git-hooks/pre-commit.sh .git/hooks/pre-commit
ln -s tools/scripts/git-hooks/pre-push.sh .git/hooks/pre-push
```

## Contributions

Feel free to open any PR with your ideas, suggestions or improvements.

### Installing this repository locally

```bash
docker-compose up -d
docker-compose exec php_scaffolding composer install
docker exec -ti -u dev php_scaffolding bash
```

Check out your code via the web browser creating a development server:

```
docker-compose exec php_scaffolding php -S 0.0.0.0:8080 public/index.php
```
