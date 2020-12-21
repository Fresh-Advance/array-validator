<?php

namespace Sieg\ArrayValidator\Rule;

use Sieg\ArrayValidator\Exception\RuleFailed;

class EqualsToKey extends AbstractRule
{
    public const MESSAGE = 'VALIDATOR_RULE_EQUALS_TO_KEY_MATCH_FAILED';

    /** @var string */
    private $key;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * @param mixed[] $data
     */
    public function process(string $key, array $data): bool
    {
        if ($this->key && (!isset($data[$this->key]) || $data[$key] !== $data[$this->key])) {
            throw new RuleFailed(self::MESSAGE);
        }

        return true;
    }
}
