<?php

declare(strict_types=1);

namespace App\Domain;

use function array_reduce;

/** @psalm-immutable */
final class AnyLogic
{
    public static function sum(int ...$numbers): int
    {
        return array_reduce(
            $numbers,
            static fn (int $carry, int $current): int => $carry + $current,
            $initial = 0
        );
    }
}
