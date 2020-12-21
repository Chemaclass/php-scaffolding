<?php

declare(strict_types=1);

namespace App\ExampleModule;

use App\ExampleModule\Domain\AdderInterface;

interface ExampleModuleFactoryInterface
{
    public function createAdder(): AdderInterface;
}
