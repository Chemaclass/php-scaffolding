<?php

declare(strict_types=1);

namespace Tests\Unit\Domain;

use App\Domain\Math;
use PHPUnit\Framework\TestCase;

final class MathTest extends TestCase
{
    private Math $math;

    public function setUp(): void
    {
        $this->math = new Math();
    }

    public function test_sum(): void
    {
        self::assertSame(0, $this->math->sum());
        self::assertSame(1, $this->math->sum(1));
        self::assertSame(3, $this->math->sum(1, 2));
        self::assertSame(6, $this->math->sum(1, 2, 3));
        self::assertSame(10, $this->math->sum(1, 2, 3, 4));
    }

    public function test_sub(): void
    {
        self::assertSame(2, $this->math->sub(6, 4));
    }
}
