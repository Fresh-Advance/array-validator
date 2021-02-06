<?php

namespace Sieg\ArrayValidator\Rule;

use Sieg\ArrayValidator\Exception\RuleFailed;

class Filter extends AbstractRule
{
    public const MESSAGE = 'VALIDATOR_RULE_FILTER_FAILED';

    /** @var int */
    private $rule;

    /** @var array<mixed> */
    private $options = [];

    /**
     * Filter constructor.
     *
     * @param int $filterRule
     * @param array<mixed> $filterOptions
     */
    public function __construct(int $filterRule, array $filterOptions = [])
    {
        $this->rule = $filterRule;
        $this->options = $filterOptions;
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
