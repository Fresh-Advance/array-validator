<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Exception\RuleFailed;
use Sieg\ArrayValidator\Rule;

class RangeTest extends TestCase
{
    /**
     * @var mixed[]
     */
    protected $exampleData = [
        'key1' => '50',
        'key2' => 50
    ];

    /**
     * @dataProvider processSuccessDataProvider
     */
    public function testProcessSuccess(string $key, int $min, int $max): void
    {
        $rule = new Rule\Range($min, $max);
        $this->assertTrue($rule->process($key, $this->exampleData));
    }

    /**
     * @return array[]
     */
    public function processSuccessDataProvider(): array
    {
        return [
            ['key1', 30, 70],
            ['key1', 30, 50],
            ['key1', 50, 70],
            ['key2', 30, 70],
            ['key2', 30, 50],
            ['key2', 50, 70]
        ];
    }

    /**
     * @dataProvider processFailedDataProvider
     */
    public function testProcessFailed(string $key, int $min, int $max, string $exception): void
    {
        $this->expectExceptionMessage($exception);
        $this->expectException(RuleFailed::class);

        $rule = new Rule\Range($min, $max);
        $rule->process('key1', $this->exampleData);
    }

    /**
     * @return array[]
     */
    public function processFailedDataProvider(): array
    {
        return [
            ['key1', 20, 40, Rule\Max::MESSAGE],
            ['key1', 60, 80, Rule\Min::MESSAGE],
            ['key2', 20, 40, Rule\Max::MESSAGE],
            ['key2', 60, 80, Rule\Min::MESSAGE]
        ];
    }
}
