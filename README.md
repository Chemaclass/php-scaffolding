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
  * `bin/csfix` -> run the php style fixer 
  * `bin/tests` -> run phpunit

## Installation

Feel free to clone this repository.

## Contributions

Feel free to open any PR with your suggestions or improvements.
