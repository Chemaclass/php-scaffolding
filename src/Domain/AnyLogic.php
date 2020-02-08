<?php

declare(strict_types=1);

namespace Domain;

final class AnyLogic
{
    public function sum(int ...$numbers): int
    {
        return array_reduce(
            $numbers,
            fn(int $carry, int $current) => $carry + $current,
            $initial = 0
        );
    }
}
