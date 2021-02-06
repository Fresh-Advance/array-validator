<?php

namespace Sieg\ArrayValidator\Tests\Rule;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Exception\RuleFailed;
use Sieg\ArrayValidator\Rule;

class CallbackTest extends TestCase
{
    public function testProcessCallbackMethodSuccess(): void
    {
        $rule = new Rule\Callback(function ($key, $data) {
            return true;
        });
        $this->assertTrue($rule->process('field1', []));
    }

    public function testProcessRemoteClassMethod(): void
    {
        $rule = new Rule\Callback([$this, "exampleCallback"]);
        $this->assertTrue($rule->process('field1', []));
    }

    /** example callback method for testing remote callback */
    public function exampleCallback(): bool
    {
        return true;
    }

    public function testProcessFailed(): void
    {
        $this->expectExceptionMessage(Rule\Callback::MESSAGE);
        $this->expectException(RuleFailed::class);

        $rule = new Rule\Callback(function ($key, $data) {
            return false;
        });
        $this->assertTrue($rule->process('field1', []));
    }

    public function testProcessDataAccess(): void
    {
        $rule = new Rule\Callback(function ($key, $data) {
            if ($data[$key] === 'correct') {
                return true;
            }

            return false;
        });

        $this->assertTrue($rule->process('field1', [
            'field1' => 'correct',
            'field2' => 'wrong'
        ]));
    }
}
