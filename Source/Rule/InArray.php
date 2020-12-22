<?php

namespace Sieg\ArrayValidator\Rule;

use Sieg\ArrayValidator\Exception\RuleFailed;

class InArray extends AbstractRule
{
    public const MESSAGE = 'VALIDATOR_RULE_IN_ARRAY_FAILED';

    /** @var string[] */
    private $choices;

    /**
     * InArray constructor.
     *
     * @param string[] $choices
     */
    public function __construct(array $choices)
    {
        $this->choices = $choices;
    }

    /**
     * @param mixed[] $data
     */
    public function process(string $key, array $data): bool
    {
        if (!isset($data[$key]) || !in_array($data[$key], $this->choices)) {
            throw new RuleFailed(self::MESSAGE);
        }

        return true;
    }
}
