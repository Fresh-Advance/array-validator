<?php

namespace Sieg\ArrayValidator\Rule;

use Sieg\ArrayValidator\Exception\RuleFailed;

class Expression extends AbstractRule
{
    public const MESSAGE = 'VALIDATOR_RULE_EXPRESSION_MATCH_FAILED';

    private string $expression;

    public function __construct(string $expression)
    {
        $this->expression = $expression;
    }

    /**
     * @param mixed[] $data
     */
    public function process(string $key, array $data): bool
    {
        if (!isset($data[$key]) || !preg_match($this->expression, $data[$key])) {
            throw new RuleFailed(self::MESSAGE);
        }

        return true;
    }
}
