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
        self::assertEquals(0, $this->logic->sum());
        self::assertEquals(1, $this->logic->sum(1));
        self::assertEquals(3, $this->logic->sum(1, 2));
        self::assertEquals(6, $this->logic->sum(1, 2, 3));
        self::assertEquals(10, $this->logic->sum(1, 2, 3, 4));
    }
}
