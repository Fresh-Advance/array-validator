<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Exception\RuleFailed;

class RuleFailedTest extends TestCase
{
    public function testThrowable()
    {
        $this->expectException(RuleFailed::class);
        throw new RuleFailed();
    }
}
