<?php

namespace Sieg\ArrayValidator\Tests\Keys;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Exception\FieldsListError;
use Sieg\ArrayValidator\Keys\Expression;

class ExpressionTest extends TestCase
{
    /**
     * @dataProvider dataProviderTestWrongExpression
     */
    public function testWrongExpression(string $testExpression): void
    {
        $this->expectException(FieldsListError::class);
        $result = new Expression($testExpression);
    }

    /**
     * @return array<int,array<int, string>>
     */
    public function dataProviderTestWrongExpression(): array
    {
        return [
            [''],
            ['someString']
        ];
    }

    public function testGoodExpression(): void
    {
        $arrayKeys = [
            'key11',
            'key12',
            'key21',
            'key22'
        ];

        $fieldList = new Expression('/key2/');
        $filteredKeys = $fieldList->filter($arrayKeys);

        $this->assertEquals(
            [
                'key21',
                'key22'
            ],
            $filteredKeys
        );
    }
}
