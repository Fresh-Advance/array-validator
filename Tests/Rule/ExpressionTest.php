<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use PHPUnit\Framework\TestCase;
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

    /**
     * @expectedException \Sieg\ArrayValidator\Exception\RuleFailed
     * @expectedExceptionMessage \Sieg\ArrayValidator\Rule\Expression::MESSAGE
     */
    public function testProcessFailed()
    {
        $config = [
            'pattern' => '/something/i'
        ];
        $rule = new Expression($config);
        $rule->process('field2', $this->exampleData);
    }

    /**
     * @expectedException \Sieg\ArrayValidator\Exception\RuleFailed
     * @expectedExceptionMessage Custom message
     */
    public function testMessageConfig()
    {
        $config = [
            'pattern' => '/something/i',
            'message' => 'Custom message'
        ];
        $rule = new Expression($config);
        $rule->process('field2', $this->exampleData);
    }
}
