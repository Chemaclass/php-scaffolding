# PHP Scaffolding

[![MIT Software License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

This is a scaffolding for PHP projects. A basic structure ready to start coding in `src` and `tests`.

### Some composer scripts

```bash
composer test-all     # run test-quality & test-unit
composer test-quality # run csrun & psalm
composer test-unit    # run phpunit

composer csrun  # check code style
composer psalm  # run Psalm coverage
```

### Git hooks

* `pre-commit.sh`
* `pre-push.sh`

#### Installation

```bash
ln -s tools/scripts/git-hooks/pre-commit.sh .git/hooks/pre-commit
ln -s tools/scripts/git-hooks/pre-push.sh .git/hooks/pre-push
```

### Contributions

Feel free to open any PR with your ideas, suggestions or improvements.

Or contact me directly via [Twitter](https://twitter.com/Chemaclass).
