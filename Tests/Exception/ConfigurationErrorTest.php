<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Exception\ConfigurationError;

class ConfigurationErrorTest extends TestCase
{
    /**
     * @expectedException \Sieg\ArrayValidator\Exception\ConfigurationError
     */
    public function testThrowable()
    {
        throw new ConfigurationError();
    }
}
