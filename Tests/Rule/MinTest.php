<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Exception\RuleFailed;
use Sieg\ArrayValidator\Rule;

class MinTest extends TestCase
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
    public function testProcessSuccess(string $key, int $min): void
    {
        $rule = new Rule\Min($min);
        $this->assertTrue($rule->process($key, $this->exampleData));
    }

    /**
     * @return array[]
     */
    public function processSuccessDataProvider(): array
    {
        return [
            ['key1', 10],
            ['key2', 10],
            ['key1', 50],
            ['key2', 50],
        ];
    }

    public function testProcessFail(): void
    {
        $this->expectException(RuleFailed::class);
        $this->expectExceptionMessage(Rule\Min::MESSAGE);

        $rule = new Rule\Min(60);
        $this->assertTrue($rule->process('key1', $this->exampleData));
        $this->assertTrue($rule->process('key2', $this->exampleData));
    }
}
