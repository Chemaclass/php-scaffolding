# PHP Scaffolding

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Chemaclass/php-scaffolding/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Chemaclass/php-scaffolding/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/Chemaclass/php-scaffolding/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Chemaclass/php-scaffolding/?branch=master)
[![MIT Software License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](LICENSE.md)

This is is a scaffolding for PHP projects using Docker. In this repository you will find:

* latest `php` (currently 7.4) 
* latest `phpunit`
* php style checker 
* basic dockerfile ready to use from your `docker-compose.yml`
* basic structure to start coding in `src` and `tests`
* some bash files (as helpers) to execute some commands inside the docker container such: 
  * `bin/bash` -> access into the bash
  * `bin/composer` -> run composer
  * `bin/csfix` -> run the code style fixer (`.php_cs`)
  * `bin/tests` -> run phpunit

## Installation

1) Clone (or fork) this repository
2) Modify the [dockerfile](devops/dev/php.dockerfile) in order to adjust the `WORKDIR` to your needs
   * Update the [docker-compose.yml](docker-compose.yml) file (`container_name` and `volumes` values)
3) Build the image using `docker-compose build`
4) Start the image using `docker-compose up`
5) Adapt the `bin/*` files to point to the right `container_name` and connect to the right `WORKDIR`
6) Install the dependencies `bin/composer install`

## Contributions

Feel free to open any PR with your suggestions or improvements.
