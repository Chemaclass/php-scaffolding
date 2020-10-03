<?php

declare(strict_types=1);

/** @psalm-immutable  */
final class Pair
{
    /** @var string */
    private $first;

    /** @var string */
    private $second;

    public function __construct(string $first, string $second)
    {
        $this->first = $first;
        $this->second = $second;
    }

    public function first(): string
    {
        return $this->first;
    }

    public function second(): string
    {
        return $this->second;
    }
}
