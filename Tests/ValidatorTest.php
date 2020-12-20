<?php

namespace Sieg\ArrayValidator\Tests;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Keys;
use Sieg\ArrayValidator\Rule;
use Sieg\ArrayValidator\RuleCase;
use Sieg\ArrayValidator\RuleCaseCollection;
use Sieg\ArrayValidator\Validator;

class ValidatorTest extends TestCase
{
    public function testValidateEmptyConditions(): void
    {
        $data = [
            'field1' => 'value1',
            'field2' => 'value2',
            'field3' => 'value3'
        ];

        $validator = new Validator(new RuleCaseCollection());
        $this->assertEmpty($validator->validate($data));
    }

    public function testErrors(): void
    {
        $data = [
            'field1' => 'value1',
            'field2' => 'something'
        ];

        $validator = new Validator(new RuleCaseCollection(
            new RuleCase(
                new Keys\Collection('field1', 'field2', 'field3'),
                new Rule\Required()
            ),
            new RuleCase(
                new Keys\Collection('field1', 'field3'),
                new Rule\Expression('/value\d+/')
            ),
            new RuleCase(
                new Keys\Collection('field2'),
                new Rule\Expression('/Value/i'),
                'super message'
            )
        ));

        $expected = [
            'field2' => [
                'super message'
            ],
            'field3' => [
                Rule\Required::MESSAGE,
                Rule\Expression::MESSAGE
            ]
        ];

        $this->assertEquals($expected, $validator->validate($data));
    }
}
