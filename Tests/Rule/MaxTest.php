<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Exception\RuleFailed;
use Sieg\ArrayValidator\Rule;

class MaxTest extends TestCase
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
    public function testProcessSuccess(string $key, int $max): void
    {
        $rule = new Rule\Max($max);
        $this->assertTrue($rule->process($key, $this->exampleData));
    }

    /**
     * @return array[]
     */
    public function processSuccessDataProvider(): array
    {
        return [
            ['key1', 80],
            ['key2', 80],
            ['key1', 50],
            ['key2', 50],
        ];
    }

    /**
     * @dataProvider processFailDataProvider
     */
    public function testProcessFail(string $key): void
    {
        $this->expectException(RuleFailed::class);
        $this->expectExceptionMessage(Rule\Max::MESSAGE);

        $rule = new Rule\Max(30);
        $rule->process($key, $this->exampleData);
    }

    /**
     * @return array[]
     */
    public function processFailDataProvider(): array
    {
        return [
            ['key1'],
            ['key2']
        ];
    }
}
