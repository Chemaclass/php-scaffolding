<?php

declare(strict_types=1);

namespace App\ExampleModule\Domain;

final class Adder implements AdderInterface
{
    public function add(int ...$numbers): int
    {
        return array_reduce(
            $numbers,
            static fn (int $carry, int $current): int => $carry + $current,
            $initial = 0
        );
    }
}
