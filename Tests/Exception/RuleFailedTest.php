<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use Sieg\ArrayValidator\Exception\RuleFailed;

class RuleFailedTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $exception = new RuleFailed();
        $this->assertInstanceOf(\Exception::class, $exception);
    }
}
