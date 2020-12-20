<?php

namespace Sieg\ArrayValidator\Rule;

use Sieg\ArrayValidator\Exception\RuleFailed;

class Equals extends AbstractRule
{
    public const MESSAGE = 'VALIDATOR_RULE_EQUALS_MATCH_FAILED';

    private $value;
    private $key;

    public function __construct($value = null, string $key = null)
    {
        $this->value = $value;
        $this->key = $key;
    }

    /**
     * @param mixed[] $data
     */
    public function process(string $key, array $data): bool
    {
        $this->checkKeyOption($key, $data);
        $this->checkValueOption($key, $data);

        return true;
    }

    /**
     * @param mixed[] $data
     *
     * @throws RuleFailed
     */
    protected function checkKeyOption(string $key, array $data): void
    {
        if (
            !is_null($this->key) &&
            (!isset($data[$this->key]) || $data[$key] !== $data[$this->key])
        ) {
            throw new RuleFailed(self::MESSAGE);
        }
    }

    /**
     * @param mixed[] $data
     *
     * @throws RuleFailed
     */
    protected function checkValueOption(string $key, array $data): void
    {
        if (!is_null($this->value) && $data[$key] !== $this->value) {
            throw new RuleFailed(self::MESSAGE);
        }
    }
}
