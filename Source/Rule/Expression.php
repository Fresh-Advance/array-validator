<?php

namespace Sieg\ArrayValidator\Rule;

use Sieg\ArrayValidator\Exception\RuleFailed;

class Expression extends AbstractRule
{
    public const MESSAGE = 'VALIDATOR_RULE_EXPRESSION_MATCH_FAILED';

    /**
     * @param mixed[] $data
     */
    public function process(string $key, array $data): bool
    {
        $message = $this->config['message'] ?: self::MESSAGE;

        if (!isset($data[$key]) || !preg_match($this->config['pattern'], $data[$key])) {
            throw new RuleFailed($message);
        }

        return true;
    }
}
