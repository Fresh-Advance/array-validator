<?php

namespace Sieg\ArrayValidator\Rule;

use Sieg\ArrayValidator\Exception\RuleFailed;

class Required extends AbstractRule
{
    public const MESSAGE = 'VALIDATOR_RULE_REQUIRED_FIELD_VALUE';

    public function process($key, $data)
    {
        $message = $this->config['message'] ?: self::MESSAGE;

        if (!isset($data[$key]) || is_null($data[$key]) || $data[$key] === "") {
            throw new RuleFailed($message);
        }

        return true;
    }
}
