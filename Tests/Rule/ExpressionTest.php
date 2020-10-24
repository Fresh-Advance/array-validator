<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Exception\RuleFailed;
use Sieg\ArrayValidator\Rule\Expression;

class ExpressionTest extends TestCase
{
    var $exampleData = [
        'field1' => 'some matching value',
        'field2' => 'bad field value'
    ];

    public function testProcessSuccess()
    {
        $config = [
            'pattern' => '/Matching/i'
        ];
        $rule = new Expression($config);
        $this->assertTrue($rule->process('field1', $this->exampleData));
    }

    public function testProcessFailed()
    {
        $this->expectExceptionMessage(Expression::MESSAGE);
        $this->expectException(RuleFailed::class);
        $config = [
            'pattern' => '/something/i'
        ];
        $rule = new Expression($config);
        $rule->process('field2', $this->exampleData);
    }

    public function testMessageConfig()
    {
        $this->expectExceptionMessage("Custom message");
        $this->expectException(RuleFailed::class);
        $config = [
            'pattern' => '/something/i',
            'message' => 'Custom message'
        ];
        $rule = new Expression($config);
        $rule->process('field2', $this->exampleData);
    }
}
