<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Exception\ConfigurationError;

class ConfigurationErrorTest extends TestCase
{
    public function testThrowable()
    {
        $this->expectException(ConfigurationError::class);
        throw new ConfigurationError();
    }
}
