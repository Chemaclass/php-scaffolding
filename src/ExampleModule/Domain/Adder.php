<?php

declare(strict_types=1);

namespace App\ExampleModule\Domain;

final class Adder implements AdderInterface
{
    public function add(int ...$numbers): int
    {
        return array_sum($numbers);
    }
}
