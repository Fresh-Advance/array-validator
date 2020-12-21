<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Exception\RuleFailed;
use Sieg\ArrayValidator\Rule;

class MaxLengthTest extends TestCase
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
    public function testProcessSuccess(int $length): void
    {
        $rule = new Rule\MaxLength($length);
        $this->assertTrue($rule->process('key1', $this->exampleData));
    }

    /**
     * @return array[]
     */
    public function processSuccessDataProvider(): array
    {
        return [
            [5],
            [10],
        ];
    }

    public function testProcessFail(): void
    {
        $this->expectException(RuleFailed::class);
        $this->expectExceptionMessage(Rule\MaxLength::MESSAGE);

        $rule = new Rule\MaxLength(3);
        $this->assertTrue($rule->process('key1', $this->exampleData));
    }
}
