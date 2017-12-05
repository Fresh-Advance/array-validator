<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use Sieg\ArrayValidator\Exception\RuleFailed;

class RuleFailedTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Sieg\ArrayValidator\Exception\RuleFailed
     */
    public function testThrowable()
    {
        throw new RuleFailed();
    }
}
