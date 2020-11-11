<?php

namespace Sieg\ArrayValidator\Rule;

use Sieg\ArrayValidator\Exception\RuleFailed;

class Filter extends AbstractRule
{
    public const MESSAGE = 'VALIDATOR_RULE_FILTER_FAILED';

    /**
     * @param mixed[] $data
     */
    public function process(string $key, array $data): bool
    {
        $message = $this->config['message'] ?: self::MESSAGE;
        $options = isset($this->config['options']) ? $this->config['options'] : null;

        if (!isset($data[$key]) || false === filter_var($data[$key], $this->config['rule'], $options)) {
            throw new RuleFailed($message);
        }

        return true;
    }
}
