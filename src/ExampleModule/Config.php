<?php

declare(strict_types=1);

namespace App\ExampleModule;

use Gacela\Framework\AbstractConfig;

final class Config extends AbstractConfig
{
    public function getBaseAdderNumber(): int
    {
        return (int) $this->get('base-adder-number');
    }
}
