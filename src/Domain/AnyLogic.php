<?php

declare(strict_types=1);

namespace Domain;

use function array_reduce;

final class AnyLogic
{
    public function sum(int ...$numbers): int
    {
        return array_reduce(
            $numbers,
            fn (int $carry, int $current) => $carry + $current,
            $initial = 0
        );
    }
}
