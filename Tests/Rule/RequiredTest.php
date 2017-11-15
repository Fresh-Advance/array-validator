<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Rule\Required;

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
        $rule = new Required();
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
     *
     * @expectedException \Sieg\ArrayValidator\Exception\RuleFailed
     * @expectedExceptionMessage \Sieg\ArrayValidator\Rule\Required::MESSAGE
     */
    public function testProcessFailed($key)
    {
        $rule = new Required();
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
}
