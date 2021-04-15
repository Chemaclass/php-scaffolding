<?php

declare(strict_types=1);

namespace App\ExampleModule;

use Gacela\Framework\AbstractFacade;

/**
 * @method ExampleModuleFactory getFactory()
 */
final class ExampleModuleFacade extends AbstractFacade
{
    public function add(int ...$numbers): int
    {
        return $this->getFactory()
            ->createAdder()
            ->add(...$numbers);
    }
}
