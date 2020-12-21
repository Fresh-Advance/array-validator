<?php

namespace Sieg\ArrayValidator\Rule;

use Sieg\ArrayValidator\Exception\RuleFailed;

class Filter extends AbstractRule
{
    public const MESSAGE = 'VALIDATOR_RULE_FILTER_FAILED';

    /** @var int */
    private $rule;

    /** @var array<mixed>|null */
    private $options;

    /**
     * Filter constructor.
     *
     * @param int $filterRule
     * @param array<mixed>|null $filterOptions
     */
    public function __construct(int $filterRule, array $filterOptions = null)
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
