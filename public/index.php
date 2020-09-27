<?php

declare(strict_types=1);

use Domain\AnyLogic;

require dirname(__DIR__) . '/vendor/autoload.php';

echo AnyLogic::sum(1, 2, 3) . PHP_EOL;
