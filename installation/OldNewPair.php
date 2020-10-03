<?php

declare(strict_types=1);

/** @psalm-immutable  */
final class OldNewPair
{
    /** @var string */
    private $old;

    /** @var string */
    private $new;

    public function __construct(string $old, string $new)
    {
        $this->old = $old;
        $this->new = $new;
    }

    public function old(): string
    {
        return $this->old;
    }

    public function new(): string
    {
        return $this->new;
    }
}

