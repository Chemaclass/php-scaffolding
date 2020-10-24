<?php

declare(strict_types=1);

namespace App;

use function array_reduce;

/**
 * This is an example of your logic-entry-point.
 *
 * @psalm-immutable
 */
final class PhpScaffolding
{
    public static function sum(int ...$numbers): int
    {
        return array_reduce(
            $numbers,
            static fn(int $carry, int $current): int => $carry + $current,
            $initial = 0
        );
    }
}
