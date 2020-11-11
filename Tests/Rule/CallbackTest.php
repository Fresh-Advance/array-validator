<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Exception\RuleFailed;
use Sieg\ArrayValidator\Rule;

class CallbackTest extends TestCase
{
    public function testProcessCallbackMethodSuccess()
    {
        $config = [
            'callback' => function ($key, $data) {
                return true;
            }
        ];
        $rule = new Rule\Callback($config);
        $this->assertTrue($rule->process('field1', []));
    }

    public function testProcessRemoteClassMethod()
    {
        $config = [
            'callback' => [$this, "exampleCallback"]
        ];
        $rule = new Rule\Callback($config);
        $this->assertTrue($rule->process('field1', []));
    }

    /** example callback method for testing remote callback */
    public function exampleCallback()
    {
        return true;
    }

    public function testProcessFailed()
    {
        $this->expectExceptionMessage(Rule\Callback::MESSAGE);
        $this->expectException(RuleFailed::class);

        $config = [
            'callback' => function ($key, $data) {
                return false;
            }
        ];
        $rule = new Rule\Callback($config);
        $this->assertTrue($rule->process('field1', []));
    }
}
