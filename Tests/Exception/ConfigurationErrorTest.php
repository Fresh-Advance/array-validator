<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use Sieg\ArrayValidator\Exception\ConfigurationError;

class ConfigurationErrorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Sieg\ArrayValidator\Exception\ConfigurationError
     */
    public function testThrowable()
    {
        throw new ConfigurationError();
    }
}
