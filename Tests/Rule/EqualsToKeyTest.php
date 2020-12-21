<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Exception\RuleFailed;
use Sieg\ArrayValidator\Rule;

class EqualsToKeyTest extends TestCase
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

    public function testProcessKeySuccess(): void
    {
        $rule = new Rule\EqualsToKey('field3x');
        $this->assertTrue($rule->process('field3', $this->exampleData));
    }

    public function testProcessKeyFailed(): void
    {
        $this->expectExceptionMessage(Rule\EqualsToKey::MESSAGE);
        $this->expectException(RuleFailed::class);

        $rule = new Rule\EqualsToKey('field2');
        $this->assertTrue($rule->process('field1', $this->exampleData));
    }
}
