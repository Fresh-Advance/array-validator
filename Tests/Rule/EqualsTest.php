<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Rule\Equals;

class EqualsTest extends TestCase
{
    var $exampleData = [
        'field1' => 'fieldvalue1',
        'field2' => 'fieldvalue2',
        'field3' => 'fieldvalue3',
        'field3x' => 'fieldvalue3'
    ];

    public function testProcessValueSuccess()
    {
        $config = [
            'value' => 'fieldvalue1'
        ];
        $rule = new Equals($config);
        $this->assertTrue($rule->process('field1', $this->exampleData));
    }

    public function testProcessKeySuccess()
    {
        $config = [
            'key' => 'field3x'
        ];
        $rule = new Equals($config);
        $this->assertTrue($rule->process('field3', $this->exampleData));
    }

    /**
     * @expectedException \Sieg\ArrayValidator\Exception\RuleFailed
     * @expectedExceptionMessage \Sieg\ArrayValidator\Rule\Equals::MESSAGE
     */
    public function testProcessValueFailed()
    {
        $config = [
            'value' => 'fieldvalue2'
        ];
        $rule = new Equals($config);
        $this->assertTrue($rule->process('field1', $this->exampleData));
    }

    /**
     * @expectedException \Sieg\ArrayValidator\Exception\RuleFailed
     * @expectedExceptionMessage \Sieg\ArrayValidator\Rule\Equals::MESSAGE
     */
    public function testProcessKeyFailed()
    {
        $config = [
            'key' => 'field2'
        ];
        $rule = new Equals($config);
        $this->assertTrue($rule->process('field1', $this->exampleData));
    }
}
