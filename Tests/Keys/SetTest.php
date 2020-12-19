<?php

namespace Sieg\ArrayValidator\Tests\Keys;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Keys\Collection;

class SetTest extends TestCase
{
    public function testSetFilter(): void
    {
        $arrayKeys = [
            'key11',
            'key12',
            'key21',
            'key22'
        ];

        $fieldList = new Collection('key12', 'key21', 'key33', true);
        $filteredKeys = $fieldList->filter($arrayKeys);

        $this->assertEquals(
            [
                'key12',
                'key21'
            ],
            $filteredKeys
        );
    }
}
