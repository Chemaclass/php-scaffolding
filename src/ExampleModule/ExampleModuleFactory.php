<?php

declare(strict_types=1);

namespace App\ExampleModule;

use App\ExampleModule\Domain\Adder;
use App\ExampleModule\Domain\AdderInterface;

final class ExampleModuleFactory implements ExampleModuleFactoryInterface
{
    public function createAdder(): AdderInterface
    {
        return new Adder();
    }
}
