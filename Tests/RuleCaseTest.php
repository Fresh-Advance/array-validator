<?php

namespace Sieg\ArrayValidator\Tests;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Keys;
use Sieg\ArrayValidator\Rule\AbstractRule;
use Sieg\ArrayValidator\RuleCase;

class RuleCaseTest extends TestCase
{
    public function testFilterFields()
    {
        $abstractRule = $this->getMockForAbstractClass(AbstractRule::class);
        $case = new RuleCase(
            new Keys\Collection('field1', 'field2'),
            $abstractRule
        );

        $keys = [
            'someField',
            'field1',
            'field2',
            'otherField'
        ];

        $this->assertSame(
            ['field1', 'field2'],
            $case->filterFields($keys)
        );
    }

    public function testGetRule()
    {
        $abstractRule = $this->getMockForAbstractClass(AbstractRule::class);
        $case = new RuleCase(
            new Keys\Collection('field1', 'field2'),
            $abstractRule
        );

        $this->assertSame(
            $abstractRule,
            $case->getRule()
        );
    }

    public function testGetDefaultMessage()
    {
        $abstractRule = $this->getMockForAbstractClass(AbstractRule::class);
        $case = new RuleCase(
            new Keys\All(),
            $abstractRule
        );

        $this->assertNull($case->getMessage());
    }

    public function testSpecialMessage()
    {
        $abstractRule = $this->getMockForAbstractClass(AbstractRule::class);
        $message = 'Special message';

        $case = new RuleCase(
            new Keys\All(),
            $abstractRule,
            $message
        );

        $this->assertSame($message, $case->getMessage());
    }
}
