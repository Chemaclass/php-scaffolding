<?php

declare(strict_types=1);

namespace App\ExampleModule\Domain;

interface AdderInterface
{
    public function add(int ...$numbers): int;
}
