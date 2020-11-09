<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Exception\RuleFailed;
use Sieg\ArrayValidator\Rule;

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
        $rule = new Rule\Equals($config);
        $this->assertTrue($rule->process('field1', $this->exampleData));
    }

    public function testProcessKeySuccess()
    {
        $config = [
            'key' => 'field3x'
        ];
        $rule = new Rule\Equals($config);
        $this->assertTrue($rule->process('field3', $this->exampleData));
    }

    public function testProcessValueFailed()
    {
        $this->expectExceptionMessage(Rule\Equals::MESSAGE);
        $this->expectException(RuleFailed::class);
        $config = [
            'value' => 'fieldvalue2'
        ];
        $rule = new Rule\Equals($config);
        $this->assertTrue($rule->process('field1', $this->exampleData));
    }

    public function testProcessKeyFailed()
    {
        $this->expectExceptionMessage(Rule\Equals::MESSAGE);
        $this->expectException(RuleFailed::class);
        $config = [
            'key' => 'field2'
        ];
        $rule = new Rule\Equals($config);
        $this->assertTrue($rule->process('field1', $this->exampleData));
    }
}
