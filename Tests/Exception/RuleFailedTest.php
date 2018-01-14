<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Exception\RuleFailed;

class RuleFailedTest extends TestCase
{
    /**
     * @expectedException \Sieg\ArrayValidator\Exception\RuleFailed
     */
    public function testThrowable()
    {
        throw new RuleFailed();
    }
}
