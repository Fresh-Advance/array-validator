<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Exception\RuleFailed;
use Sieg\ArrayValidator\Rule;

class MinLengthTest extends TestCase
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
        $rule = new Rule\MinLength($length);
        $this->assertTrue($rule->process('key1', $this->exampleData));
    }

    /**
     * @return array[]
     */
    public function processSuccessDataProvider(): array
    {
        return [
            [5],
            [3],
        ];
    }

    public function testProcessFail(): void
    {
        $this->expectException(RuleFailed::class);
        $this->expectExceptionMessage(Rule\MinLength::MESSAGE);

        $rule = new Rule\MinLength(7);
        $this->assertTrue($rule->process('key1', $this->exampleData));
    }
}
