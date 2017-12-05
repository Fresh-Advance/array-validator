<?php

namespace Sieg\ArrayValidator\Rule;

use Sieg\ArrayValidator\Exception\RuleFailed;

class Filter extends AbstractRule
{
    const MESSAGE = 'VALIDATOR_RULE_FILTER_FAILED';

    public function process($key, $data)
    {
        $message = $this->config['message'] ?: self::MESSAGE;

        if (!isset($data[$key]) || false === filter_var($data[$key], $this->config['rule'], $this->config['options'])) {
            throw new RuleFailed($message);
        }

        return true;
    }
}
