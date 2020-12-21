<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Exception\RuleFailed;
use Sieg\ArrayValidator\Rule;

class EqualsToTest extends TestCase
{
    /**
     * @var mixed[]
     */
    protected $exampleData = [
        'field1' => 'fieldvalue1',
        'field2' => null,
        'field3' => 'fieldvalue3',
        'field3x' => 'fieldvalue3'
    ];

    public function testProcessValueSuccess(): void
    {
        $rule = new Rule\EqualsTo('fieldvalue1');
        $this->assertTrue($rule->process('field1', $this->exampleData));
    }

    public function testProcessValueOnNull(): void
    {
        $rule = new Rule\EqualsTo(null);
        $this->assertTrue($rule->process('field2', $this->exampleData));
    }

    public function testProcessValueFailed(): void
    {
        $this->expectExceptionMessage(Rule\EqualsTo::MESSAGE);
        $this->expectException(RuleFailed::class);

        $rule = new Rule\EqualsTo('fieldvalue2');
        $this->assertTrue($rule->process('field1', $this->exampleData));
    }
}
