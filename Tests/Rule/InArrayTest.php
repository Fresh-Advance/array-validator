<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Exception\RuleFailed;
use Sieg\ArrayValidator\Rule;

class InArrayTest extends TestCase
{
    /**
     * @var mixed[]
     */
    protected $exampleData = [
        'key1' => '12345'
    ];

    public function testProcessSuccess(): void
    {
        $rule = new Rule\InArray(['some', 'values', '12345']);
        $this->assertTrue($rule->process('key1', $this->exampleData));
    }

    /**
     * @dataProvider processFailedDataProvider
     *
     * @param string[] $array
     */
    public function testProcessFailed(array $array): void
    {
        $this->expectExceptionMessage(Rule\InArray::MESSAGE);
        $this->expectException(RuleFailed::class);

        $rule = new Rule\InArray($array);
        $rule->process('key1', $this->exampleData);
    }

    /**
     * @return array[]
     */
    public function processFailedDataProvider(): array
    {
        return [
            [['some', 'failing', 'example']],
            [[]],
            [['123456', '123']]
        ];
    }
}
