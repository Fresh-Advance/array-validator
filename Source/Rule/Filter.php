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
     * @param int $rule
     * @param array<mixed>|null $options
     */
    public function __construct(int $rule, array $options = null)
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
