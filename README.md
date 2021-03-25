# PHP Scaffolding

[![MIT Software License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](LICENSE.md)

This is a scaffolding for PHP projects using Docker. 

In this repository you will find:

* `PHP` ([7.4](https://en.wikipedia.org/wiki/PHP#Release_history))
* `Composer` (currently [2.0](https://getcomposer.org/))
* `PHPUnit` (currently [9](https://phpunit.de/announcements/phpunit-9.html)) 
* `XDebug` (currently [3](https://xdebug.org/docs/))
* `Psalm` (currently [4](https://github.com/vimeo/psalm))
* A basic `Dockerfile` ready to use from your `docker-compose.yml`
* Basic structure ready to start coding in `src` and `tests`

## Setup

```bash
curl -sS https://raw.githubusercontent.com/Chemaclass/php-scaffolding/master/setup.sh > setup.sh
bash setup.sh YourNewProjectName
rm setup.sh
```

#### Getting the bash from your project

```bash
docker exec -ti -u dev your_project_name bash
```

#### Some composer scripts

```bash
composer test-all     # run test-quality & test-unit
composer test-quality # run csrun & psalm
composer test-unit    # run phpunit

composer csrun  # check code style
composer psalm  # run Psalm coverage
```

### Git hooks

* `./tools/scripts/git-hooks/pre-commit.sh`
* `./tools/scripts/git-hooks/pre-push.sh`

#### Installation

```bash
ln -s tools/scripts/git-hooks/pre-commit.sh .git/hooks/pre-commit
ln -s tools/scripts/git-hooks/pre-push.sh .git/hooks/pre-push
```

## Contributions

Installing this repository locally

```bash
docker-compose up -d
docker-compose exec php_scaffolding composer install
docker-compose exec -u dev php_scaffolding composer test-all
docker exec -ti -u dev php_scaffolding bash
```

Feel free to open any PR with your ideas, suggestions or improvements.

Or contact me directly via [Twitter](https://twitter.com/Chemaclass).
