<?php

namespace Sieg\ArrayValidator\Rule;

use Sieg\ArrayValidator\Exception\RuleFailed;

class Equals extends AbstractRule
{
    public const MESSAGE = 'VALIDATOR_RULE_EQUALS_MATCH_FAILED';

    /**
     * @param mixed[] $data
     */
    public function process(string $key, array $data): bool
    {
        $message = $this->config['message'] ?: self::MESSAGE;

        $this->checkKeyOption($key, $data, $message);
        $this->checkValueOption($key, $data, $message);

        return true;
    }

    /**
     * @param mixed[] $data
     *
     * @throws RuleFailed
     */
    protected function checkKeyOption(string $key, array $data, string $message): void
    {
        if (
            isset($this->config['key']) &&
            (!isset($data[$this->config['key']]) || $data[$key] !== $data[$this->config['key']])
        ) {
            throw new RuleFailed($message);
        }
    }

    /**
     * @param mixed[] $data
     *
     * @throws RuleFailed
     */
    protected function checkValueOption(string $key, array $data, string $message): void
    {
        if (isset($this->config['value']) && $data[$key] !== $this->config['value']) {
            throw new RuleFailed($message);
        }
    }
}
