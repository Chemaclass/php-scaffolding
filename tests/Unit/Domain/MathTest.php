<?php

declare(strict_types=1);

namespace Tests\Unit\Domain;

use App\Domain\Math;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Domain\Math
 *
 * @internal
 */
final class MathTest extends TestCase
{
    public function testSum(): void
    {
        static::assertSame(0, Math::sum());
        static::assertSame(1, Math::sum(1));
        static::assertSame(3, Math::sum(1, 2));
        static::assertSame(6, Math::sum(1, 2, 3));
        static::assertSame(10, Math::sum(1, 2, 3, 4));
    }

    public function testSub(): void
    {
        static::assertSame(2, Math::sub(6, 4));
    }
}
