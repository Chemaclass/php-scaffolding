#!/usr/local/bin/php
<?php

declare(strict_types=1);

use App\ExampleModule\ExampleModuleFacade;
use App\ExampleModule\ExampleModuleFactory;

require dirname(__DIR__) . '/vendor/autoload.php';

$facade = new ExampleModuleFacade(
    new ExampleModuleFactory()
);

$sum = $facade->add(1, 2, 3);
echo "The sum: {$sum}" . PHP_EOL;
