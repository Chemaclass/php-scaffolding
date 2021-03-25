<?php

declare(strict_types=1);

namespace Tests\Unit\ExampleModule\Domain;

use App\ExampleModule\Domain\Adder;
use Generator;
use PHPUnit\Framework\TestCase;

final class AdderTest extends TestCase
{
    /**
     * @dataProvider providerAdd
     */
    public function testItCanAdd(int $expected, array $numbers): void
    {
        $facade = new Adder();

        self::assertSame($expected, $facade->add(...$numbers));
    }

    public function providerAdd(): Generator
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
