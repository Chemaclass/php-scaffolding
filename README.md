# PHP Scaffolding

[![MIT Software License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

This is a scaffolding for PHP projects. A basic structure ready to start coding in `src` and `tests`.

### Some composer scripts

```bash
composer test-all     # run test-quality & test-phpunit
composer test-quality # run csrun & psalm
composer test-phpunit # run phpunit

composer csrun  # check code style
composer psalm  # run Psalm coverage
```

### Git hooks

Install the pre-commit hook running:

```bash
./tools/git-hooks/init.sh
```

### Basic Dockerfile

If you don't have PHP in your local machine, you can simply use docker to build a docker image with `PHP 8.0`.

```bash
docker build -t php-scaffolding .
```

### Contributions

Feel free to open any PR with your ideas, suggestions or improvements.

Or contact me directly via [Twitter](https://twitter.com/Chemaclass).
