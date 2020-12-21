<?php

declare(strict_types=1);

namespace Tests\Unit\ExampleModule;

use App\ExampleModule\ExampleModuleFacade;
use App\ExampleModule\ExampleModuleFactory;
use PHPUnit\Framework\TestCase;

final class ExampleModuleFacadeTest extends TestCase
{
    /** @test */
    public function itCanAdd(): void
    {
        $facade = new ExampleModuleFacade(
            new ExampleModuleFactory()
        );

        self::assertSame(0, $facade->add());
        self::assertSame(1, $facade->add(1));
        self::assertSame(3, $facade->add(1, 2));
        self::assertSame(6, $facade->add(1, 2, 3));
        self::assertSame(10, $facade->add(1, 2, 3, 4));
    }
}
