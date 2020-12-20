<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Exception\RuleFailed;
use Sieg\ArrayValidator\Rule;

class EqualsTest extends TestCase
{
    /**
     * @var mixed[]
     */
    protected $exampleData = [
        'field1' => 'fieldvalue1',
        'field2' => 'fieldvalue2',
        'field3' => 'fieldvalue3',
        'field3x' => 'fieldvalue3'
    ];

    public function testProcessValueSuccess(): void
    {
        $rule = new Rule\Equals('fieldvalue1');
        $this->assertTrue($rule->process('field1', $this->exampleData));
    }

    public function testProcessKeySuccess(): void
    {
        $rule = new Rule\Equals(null, 'field3x');
        $this->assertTrue($rule->process('field3', $this->exampleData));
    }

    public function testProcessValueFailed(): void
    {
        $this->expectExceptionMessage(Rule\Equals::MESSAGE);
        $this->expectException(RuleFailed::class);

        $rule = new Rule\Equals('fieldvalue2');
        $this->assertTrue($rule->process('field1', $this->exampleData));
    }

    public function testProcessKeyFailed(): void
    {
        $this->expectExceptionMessage(Rule\Equals::MESSAGE);
        $this->expectException(RuleFailed::class);

        $rule = new Rule\Equals('field2');
        $this->assertTrue($rule->process('field1', $this->exampleData));
    }
}
