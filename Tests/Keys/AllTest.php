<?php

namespace Sieg\ArrayValidator\Tests\Keys;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Keys\All;

class AllTest extends TestCase
{
    public function testAllKeysFilter(): void
    {
        $arrayKeys = [
            'key11',
            'key12',
            'key21',
            'key22'
        ];

        $fieldList = new All();
        $filteredKeys = $fieldList->filter($arrayKeys);

        $this->assertEquals(
            $arrayKeys,
            $filteredKeys
        );
    }
}
