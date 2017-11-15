<?php

namespace Sieg\ArrayValidator\Tests;

use Sieg\ArrayValidator\Rule\Required;
use Sieg\ArrayValidator\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    public $configurationExample = [
        Required::class => [
            'fields' => ['field1', 'field2', 'field3']
        ],
//        Length::class => [
//            [
//                'fields' => ['field2', 'field3'],
//                'message' => 'Field length should be more than 3',
//                'moreThan' => 3
//            ],
//            [
//                'fields' => ['field2', 'field3'],
//                'message' => 'Field length should be less than 3',
//                'lessThan' => 10
//            ],
//        ],
//        Equals::class => [
//            'fields' => ['password'],
//            'message' => 'Some message',
//            'equalToField' => 'password2'
//        ]
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
        $this->assertTrue($validator->validate($data));
    }

    public function testEmptyGetErrors()
    {
        $validator = new Validator();
        $this->assertEmpty($validator->getErrors());
    }

    public function testOneError()
    {
        $data = [
            'field1' => 'value1',
            'field2' => 'value2'
        ];

        $validator = new Validator($this->configurationExample);
        $validator->validate($data);

        $expected = [
            'field3' => [
                Required::MESSAGE
            ]
        ];

        $this->assertEquals($expected, $validator->getErrors());
    }
}