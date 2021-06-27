<?php

declare(strict_types=1);

namespace App\Domain;

use function array_reduce;

/**
 * This is an "domain class example".
 *
 * @psalm-immutable
 */
final class Math
{
    public static function sum(int ...$numbers): int
    {
        return array_reduce(
            $numbers,
            static fn (int $carry, int $current): int => $carry + $current,
            $initial = 0
        );
    }

    public static function sub(int $n1, int $n2): int
    {
        return $n1 - $n2;
    }
}
