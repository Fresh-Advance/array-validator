<?php

namespace Sieg\ArrayValidator\Rule;

use Sieg\ArrayValidator\Exception\RuleFailed;

class Filter extends AbstractRule
{
    public const MESSAGE = 'VALIDATOR_RULE_FILTER_FAILED';

    private string $rule;
    private $options;

    public function __construct(string $rule, array $options = null)
    {
        $this->rule = $rule;
        $this->options = $options;
    }
    
    /**
     * @param mixed[] $data
     */
    public function process(string $key, array $data): bool
    {
        if (!isset($data[$key]) || false === filter_var($data[$key], $this->rule, $this->options)) {
            throw new RuleFailed(self::MESSAGE);
        }

        return true;
    }
}
