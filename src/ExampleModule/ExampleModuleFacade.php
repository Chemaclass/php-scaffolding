<?php

declare(strict_types=1);

namespace App\ExampleModule;

final class ExampleModuleFacade
{
    private ExampleModuleFactoryInterface $factory;

    public function __construct(ExampleModuleFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function add(int ...$numbers): int
    {
        return $this->factory
            ->createAdder()
            ->add(...$numbers);
    }
}
