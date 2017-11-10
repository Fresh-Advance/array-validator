<?php

namespace Sieg\ArrayValidator\Tests;

use Sieg\ArrayValidator\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $container = new Validator();
        $this->assertInstanceOf(Validator::class, $container);
    }
}