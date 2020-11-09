<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Exception\RuleFailed;
use Sieg\ArrayValidator\Rule;

class RequiredTest extends TestCase
{
    var $exampleData = [
        'field1' => 'with data',
        'field2' => '',
        'field3' => null,
        'field4' => 0
    ];

    /**
     * @dataProvider processSuccessDataProvider
     */
    public function testProcessSuccess($key)
    {
        $rule = new Rule\Required();
        $this->assertTrue($rule->process($key, $this->exampleData));
    }

    public function processSuccessDataProvider()
    {
        return [
            ['field1'],
            ['field4']
        ];
    }

    /**
     * @dataProvider processFailedDataProvider
     */
    public function testProcessFailed($key)
    {
        $this->expectExceptionMessage(Rule\Required::MESSAGE);
        $this->expectException(RuleFailed::class);

        $rule = new Rule\Required();
        $rule->process($key, $this->exampleData);
    }

    public function processFailedDataProvider()
    {
        return [
            ['field2'],
            ['field3'],
            ['field5']
        ];
    }

    public function testMessageConfig()
    {
        $this->expectExceptionMessage("Custom message");
        $this->expectException(RuleFailed::class);

        $config = [
            'message' => 'Custom message'
        ];
        $rule = new Rule\Required($config);
        $rule->process('field2', $this->exampleData);
    }
}
