<?php

declare(strict_types=1);

namespace DomainTests\Unit;

use Domain\AnyLogic;
use PHPUnit\Framework\TestCase;

final class AnyLogicTest extends TestCase
{
    private AnyLogic $logic;

    protected function setUp(): void
    {
        $this->logic = new AnyLogic();
    }

    /** @test */
    public function sum(): void
    {
        self::assertSame(0, $this->logic->sum());
        self::assertSame(1, $this->logic->sum(1));
        self::assertSame(3, $this->logic->sum(1, 2));
        self::assertSame(6, $this->logic->sum(1, 2, 3));
        self::assertSame(10, $this->logic->sum(1, 2, 3, 4));
    }
}
