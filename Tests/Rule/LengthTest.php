<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Exception\RuleFailed;
use Sieg\ArrayValidator\Rule;

class LengthTest extends TestCase
{
    /**
     * @var mixed[]
     */
    protected $exampleData = [
        'key1' => 'testString'
    ];

    /**
     * @dataProvider processSuccessDataProvider
     * @param mixed[] $config
     */
    public function testProcessSuccess(string $key, array $config): void
    {
        $rule = new Rule\Length($config);
        $this->assertTrue($rule->process($key, $this->exampleData));
    }

    /**
     * @return array[]
     */
    public function processSuccessDataProvider(): array
    {
        return [
            ["key1", ["min" => 5]],
            ["key1", ["min" => 10]],
            ["key1", ["min" => 5, "max" => 10]],
            ["key1", ["max" => 20]],
            ["key1", ["max" => 10]],
            ["key1", ["actual" => 10]]
        ];
    }

    /**
     * @dataProvider processFailedDataProvider
     * @param mixed[] $config
     */
    public function testProcessFailed(string $key, array $config): void
    {
        $this->expectExceptionMessage(Rule\Length::MESSAGE);
        $this->expectException(RuleFailed::class);
        $rule = new Rule\Length($config);
        $rule->process($key, $this->exampleData);
    }

    /**
     * @return array[]
     */
    public function processFailedDataProvider(): array
    {
        return [
            ["key1", ["min" => 11]],
            ["key1", ["max" => 5]],
            ["key1", ["actual" => 5]],
            ["key1", ["min" => 2, "max" => 5]],
            ["key1", ["min" => 12, "max" => 20]]
        ];
    }
}
