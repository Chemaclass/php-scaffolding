<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\PhpScaffolding;
use PHPUnit\Framework\TestCase;

final class PhpScaffoldingTest extends TestCase
{
    /** @test */
    public function itCanSum(): void
    {
        self::assertSame(0, PhpScaffolding::sum());
        self::assertSame(1, PhpScaffolding::sum(1));
        self::assertSame(3, PhpScaffolding::sum(1, 2));
        self::assertSame(6, PhpScaffolding::sum(1, 2, 3));
        self::assertSame(10, PhpScaffolding::sum(1, 2, 3, 4));
    }
}
