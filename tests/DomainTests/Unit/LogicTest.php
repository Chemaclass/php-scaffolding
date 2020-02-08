<?php

declare(strict_types=1);

namespace DomainTests\Unit;

use Domain\Logic;
use PHPUnit\Framework\TestCase;

final class LogicTest extends TestCase
{
    private Logic $logic;

    protected function setUp(): void
    {
        $this->logic = new Logic();
    }

    /** @test */
    public function plus(): void
    {
        self::assertEquals(4, $this->logic->plus(1, 3));
    }
}
