<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Exception\RuleFailed;
use Sieg\ArrayValidator\Rule;

class LengthRangeTest extends TestCase
{
    /**
     * @var mixed[]
     */
    protected $exampleData = [
        'key1' => '12345'
    ];

    /**
     * @dataProvider processSuccessDataProvider
     */
    public function testProcessSuccess(int $min, int $max): void
    {
        $rule = new Rule\LengthRange($min, $max);
        $this->assertTrue($rule->process('key1', $this->exampleData));
    }

    /**
     * @return array[]
     */
    public function processSuccessDataProvider(): array
    {
        return [
            [3, 7],
            [3, 5],
            [5, 7]
        ];
    }

    /**
     * @dataProvider processFailedDataProvider
     */
    public function testProcessFailed(int $min, int $max, string $exception): void
    {
        $this->expectExceptionMessage($exception);
        $this->expectException(RuleFailed::class);

        $rule = new Rule\LengthRange($min, $max);
        $rule->process('key1', $this->exampleData);
    }

    /**
     * @return array[]
     */
    public function processFailedDataProvider(): array
    {
        return [
            [2, 4, Rule\MaxLength::MESSAGE],
            [6, 8, Rule\MinLength::MESSAGE]
        ];
    }
}
