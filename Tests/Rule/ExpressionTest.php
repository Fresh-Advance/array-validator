<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Exception\RuleFailed;
use Sieg\ArrayValidator\Rule;

class ExpressionTest extends TestCase
{
    /**
     * @var mixed[]
     */
    protected $exampleData = [
        'field1' => 'some matching value',
        'field2' => 'bad field value'
    ];

    public function testProcessSuccess(): void
    {
        $rule = new Rule\Expression('/Matching/i');
        $this->assertTrue($rule->process('field1', $this->exampleData));
    }

    public function testProcessFailed(): void
    {
        $this->expectExceptionMessage(Rule\Expression::MESSAGE);
        $this->expectException(RuleFailed::class);

        $rule = new Rule\Expression('/something/i');
        $rule->process('field2', $this->exampleData);
    }
}
