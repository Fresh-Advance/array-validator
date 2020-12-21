<?php

namespace Sieg\ArrayValidator\Rule;

use Sieg\ArrayValidator\Exception\RuleFailed;

class EqualsTo extends AbstractRule
{
    public const MESSAGE = 'VALIDATOR_RULE_EQUALS_TO_MATCH_FAILED';

    /** @var mixed */
    private $value;

    /**
     * EqualsTo constructor.
     *
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param mixed[] $data
     */
    public function process(string $key, array $data): bool
    {
        if (!is_null($this->value) && $data[$key] !== $this->value) {
            throw new RuleFailed(self::MESSAGE);
        }

        return true;
    }
}
