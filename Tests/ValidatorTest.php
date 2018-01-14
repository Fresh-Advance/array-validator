<?php

namespace Sieg\ArrayValidator\Tests;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Rule\Expression;
use Sieg\ArrayValidator\Rule\Required;
use Sieg\ArrayValidator\Validator;

class ValidatorTest extends TestCase
{
    public $configurationExample = [
        Required::class => [
            'fields' => ['field1', 'field2', 'field3']
        ],
        Expression::class => [
            [
                'fields' => ['field1', 'field3'],
                'pattern' => '/value\d+/'
            ],
            [
                'fields' => ['field2'],
                'pattern' => '/Value/i',
                'message' => 'super message'
            ]
        ]
    ];

    public function testConstructor()
    {
        $validator = new Validator();
        $this->assertInstanceOf(Validator::class, $validator);
    }

    public function testValidate()
    {
        $data = [
            'field1' => 'value1',
            'field2' => 'value2',
            'field3' => 'value3'
        ];

        $validator = new Validator($this->configurationExample);
        $this->assertTrue($validator->isValid($data));
    }

    public function testEmptyGetErrors()
    {
        $validator = new Validator();
        $this->assertEmpty($validator->getErrors());
    }

    public function testErrors()
    {
        $data = [
            'field1' => 'value1',
            'field2' => 'something'
        ];

        $validator = new Validator($this->configurationExample);
        $validator->isValid($data);

        $expected = [
            'field2' => [
                'super message'
            ],
            'field3' => [
                Required::MESSAGE,
                Expression::MESSAGE
            ]
        ];

        $this->assertEquals($expected, $validator->getErrors());
    }
}
