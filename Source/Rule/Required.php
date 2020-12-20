<?php

namespace Sieg\ArrayValidator\Rule;

use Sieg\ArrayValidator\Exception\RuleFailed;

class Required extends AbstractRule
{
    public const MESSAGE = 'VALIDATOR_RULE_REQUIRED_FIELD_VALUE';

    /**
     * @param mixed[] $data
     */
    public function process(string $key, array $data): bool
    {
        if (!isset($data[$key]) || is_null($data[$key]) || $data[$key] === "") {
            throw new RuleFailed(self::MESSAGE);
        }

        return true;
    }
}
