#!/usr/local/bin/php
<?php

declare(strict_types=1);

use App\ExampleModule\Facade;

require dirname(__DIR__) . '/vendor/autoload.php';

$facade = new Facade();
$sum = $facade->add(1, 2, 3);

print "The sum: {$sum}" . PHP_EOL;
