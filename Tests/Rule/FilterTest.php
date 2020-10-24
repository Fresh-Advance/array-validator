<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Exception\RuleFailed;
use Sieg\ArrayValidator\Rule\Filter;

class FilterTest extends TestCase
{
    var $exampleData = [
        'field1' => 'some@email.com',
        'field2' => 1.2,
        'field3' => '1.2',
        'field4' => 1,
        'field5' => '1',
        'field6' => 0,
        'field7' => 10,
        'field8' => '1.2.3.4',
        'field9' => 'FF:FF:FF:FF:FF:FF',
        'field10' => 'some regex text',
        'field11' => 'http://example.com'
    ];

    /**
     * @dataProvider successDataProvider
     *
     * @param $field
     * @param $rule
     * @param $options
     */
    public function testProcessSuccess($field, $rule, $options)
    {
        $config = [
            'rule' => $rule,
            'options' => $options
        ];
        $rule = new Filter($config);
        $this->assertTrue($rule->process($field, $this->exampleData));
    }

    public function successDataProvider()
    {
        return [
            ['field1', FILTER_VALIDATE_EMAIL, []],
            ['field2', FILTER_VALIDATE_FLOAT, []],
            ['field3', FILTER_VALIDATE_FLOAT, []],
            ['field4', FILTER_VALIDATE_FLOAT, []],
            ['field5', FILTER_VALIDATE_FLOAT, []],
            ['field6', FILTER_VALIDATE_FLOAT, []],
            ['field6', FILTER_VALIDATE_INT, []],
            ['field7', FILTER_VALIDATE_INT, []],
            ['field7', FILTER_VALIDATE_INT, [
                'options' => [
                    'min_range' => 5,
                    'max_range' => 10
                ]
            ]],
            ['field8', FILTER_VALIDATE_IP, []],
            ['field9', FILTER_VALIDATE_MAC, []],
            ['field10', FILTER_VALIDATE_REGEXP, [
                'options' => [
                    'regexp' => '/reGex/i'
                ]
            ]],
            ['field11', FILTER_VALIDATE_URL, []]
        ];
    }

    /**
     * @dataProvider failureDataProvider
     *
     * @param $field
     * @param $rule
     * @param $options
     */
    public function testProcessFailure($field, $rule, $options)
    {
        $this->expectExceptionMessage(Filter::MESSAGE);
        $this->expectException(RuleFailed::class);
        $config = [
            'rule' => $rule,
            'options' => $options
        ];
        $rule = new Filter($config);
        $rule->process($field, $this->exampleData);
    }

    public function failureDataProvider()
    {
        return [
            ['field2', FILTER_VALIDATE_EMAIL, []],
            ['field1', FILTER_VALIDATE_FLOAT, []],
            ['field1', FILTER_VALIDATE_INT, []],
            ['field7', FILTER_VALIDATE_INT, [
                'options' => [
                    'min_range' => 20
                ]
            ]],
            ['field1', FILTER_VALIDATE_IP, []],
            ['field1', FILTER_VALIDATE_MAC, []],
            ['field1', FILTER_VALIDATE_REGEXP, [
                'options' => [
                    'regexp' => '/reGex/i'
                ]
            ]],
            ['field1', FILTER_VALIDATE_URL, []]
        ];
    }
}
