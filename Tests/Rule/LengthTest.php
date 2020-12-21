<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Exception\RuleFailed;
use Sieg\ArrayValidator\Rule;

class LengthTest extends TestCase
{
    /**
     * @var mixed[]
     */
    protected $exampleData = [
        'key1' => '12345'
    ];

    public function testProcessSuccess(): void
    {
        $rule = new Rule\Length(5);
        $this->assertTrue($rule->process('key1', $this->exampleData));
    }

    /**
     * @dataProvider processFailedDataProvider
     */
    public function testProcessFailed(int $length): void
    {
        $this->expectExceptionMessage(Rule\Length::MESSAGE);
        $this->expectException(RuleFailed::class);

        $rule = new Rule\Length($length);
        $rule->process('key1', $this->exampleData);
    }

    /**
     * @return array[]
     */
    public function processFailedDataProvider(): array
    {
        return [
            [3],
            [7]
        ];
    }
}
