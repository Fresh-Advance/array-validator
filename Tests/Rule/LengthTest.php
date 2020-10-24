<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Exception\RuleFailed;
use Sieg\ArrayValidator\Rule\Length;

class LengthTest extends TestCase
{
    protected $exampleData = [
        'key1' => 'testString'
    ];

    /**
     * @dataProvider processSuccessDataProvider
     */
    public function testProcessSuccess($string, $config)
    {
        $rule = new Length($config);
        $this->assertTrue($rule->process($string, $this->exampleData));
    }

    public function processSuccessDataProvider()
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
     */
    public function testProcessFailed($string, $config)
    {
        $this->expectExceptionMessage(Length::MESSAGE);
        $this->expectException(RuleFailed::class);
        $rule = new Length($config);
        $rule->process($string, $this->exampleData);
    }


    public function processFailedDataProvider()
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
