<?php

declare(strict_types=1);

namespace Tests\Unit\ExampleModule;

use App\ExampleModule\ExampleModuleFacade;
use App\ExampleModule\ExampleModuleFactory;
use Generator;
use PHPUnit\Framework\TestCase;

final class ExampleModuleFacadeTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider adderDataProvider
     */
    public function itCanAdd(int $expected, array $numbers): void
    {
        $facade = new ExampleModuleFacade(
            new ExampleModuleFactory()
        );

        self::assertSame($expected, $facade->add(...$numbers));
    }

    public function adderDataProvider(): Generator
    {
        yield 'when no numbers, the result is zero' => [
            'expected' => 0,
            'numbers' => [],
        ];

        yield 'when a single number, the result is the same number' => [
            'expected' => 1,
            'numbers' => [1],
        ];

        yield 'when two numbers, the result is the sum of both' => [
            'expected' => 3,
            'numbers' => [1, 2],
        ];

        yield 'when multiple numbers, the result is the sum of all of them' => [
            'expected' => 10,
            'numbers' => [1, 2, 3, 4],
        ];
    }
}
