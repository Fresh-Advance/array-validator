<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Exception\RuleFailed;
use Sieg\ArrayValidator\Rule;

class RequiredTest extends TestCase
{
    /**
     * @var mixed[]
     */
    protected $exampleData = [
        'field1' => 'with data',
        'field2' => '',
        'field3' => null,
        'field4' => 0
    ];

    /**
     * @dataProvider processSuccessDataProvider
     */
    public function testProcessSuccess(string $key): void
    {
        $rule = new Rule\Required();
        $this->assertTrue($rule->process($key, $this->exampleData));
    }

    /**
     * @return array[]
     */
    public function processSuccessDataProvider(): array
    {
        return [
            ['field1'],
            ['field4']
        ];
    }

    /**
     * @dataProvider processFailedDataProvider
     */
    public function testProcessFailed(string $key): void
    {
        $this->expectExceptionMessage(Rule\Required::MESSAGE);
        $this->expectException(RuleFailed::class);

        $rule = new Rule\Required();
        $rule->process($key, $this->exampleData);
    }

    /**
     * @return array[]
     */
    public function processFailedDataProvider(): array
    {
        return [
            ['field2'],
            ['field3'],
            ['field5']
        ];
    }
}
