#!/usr/local/bin/php
<?php

declare(strict_types=1);

use App\ExampleModule\Facade;
use Gacela\Framework\Config;

require dirname(__DIR__) . '/vendor/autoload.php';

Config::setApplicationRootDir(getcwd());

$facade = new Facade();
$sum = $facade->add(1, 2, 3);

print "The sum: {$sum}" . PHP_EOL;
