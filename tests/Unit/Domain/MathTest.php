<?php

declare(strict_types=1);

namespace Tests\Unit\Domain;

use App\Domain\Math;
use PHPUnit\Framework\TestCase;

final class MathTest extends TestCase
{
    public function test_sum(): void
    {
        self::assertSame(0, Math::sum());
        self::assertSame(1, Math::sum(1));
        self::assertSame(3, Math::sum(1, 2));
        self::assertSame(6, Math::sum(1, 2, 3));
        self::assertSame(10, Math::sum(1, 2, 3, 4));
    }

    public function test_sub(): void
    {
        self::assertSame(2, Math::sub(6, 4));
    }
}
