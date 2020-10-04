<?php

declare(strict_types=1);

namespace Tests\Unit\Domain;

use App\Domain\AnyLogic;
use PHPUnit\Framework\TestCase;

final class AnyLogicTest extends TestCase
{
    /** @test */
    public function sum(): void
    {
        self::assertSame(0, AnyLogic::sum());
        self::assertSame(1, AnyLogic::sum(1));
        self::assertSame(3, AnyLogic::sum(1, 2));
        self::assertSame(6, AnyLogic::sum(1, 2, 3));
        self::assertSame(10, AnyLogic::sum(1, 2, 3, 4));
    }
}
