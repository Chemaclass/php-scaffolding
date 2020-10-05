<?php

declare(strict_types=1);

use App\Domain\Math;

require dirname(__DIR__) . '/vendor/autoload.php';

echo Math::sum(1, 2, 3) . PHP_EOL;
