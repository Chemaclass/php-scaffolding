<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Math;
use PHPUnit\Framework\TestCase;

final class MathTest extends TestCase
{
    /** @test */
    public function sum(): void
    {
        self::assertSame(0, Math::sum());
        self::assertSame(1, Math::sum(1));
        self::assertSame(3, Math::sum(1, 2));
        self::assertSame(6, Math::sum(1, 2, 3));
        self::assertSame(10, Math::sum(1, 2, 3, 4));
    }

    /** @test */
    public function sub(): void
    {
        self::assertSame(2, Math::sub(6, 4));
    }
}
