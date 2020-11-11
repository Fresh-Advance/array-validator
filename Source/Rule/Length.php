<?php

namespace Sieg\ArrayValidator\Rule;

use Sieg\ArrayValidator\Exception\RuleFailed;

class Length extends AbstractRule
{
    public const MESSAGE = 'VALIDATOR_RULE_LENGTH_FAILED';

    /**
     * @param mixed[] $data
     */
    public function process(string $key, array $data): bool
    {
        $this->checkMinOption($data[$key]);
        $this->checkMaxOption($data[$key]);
        $this->checkActualOption($data[$key]);

        return true;
    }

    /**
     * @param mixed $item
     *
     * @throws RuleFailed
     */
    protected function checkMinOption($item): void
    {
        if (isset($this->config['min']) && strlen($item) < $this->config['min']) {
            throw new RuleFailed($this->getMessage());
        }
    }

    /**
     * @param mixed $item
     *
     * @throws RuleFailed
     */
    protected function checkMaxOption($item): void
    {
        if (isset($this->config['max']) && strlen($item) > $this->config['max']) {
            throw new RuleFailed($this->getMessage());
        }
    }

    /**
     * @param mixed $item
     *
     * @throws RuleFailed
     */
    protected function checkActualOption($item): void
    {
        if (isset($this->config['actual']) && strlen($item) !== $this->config['actual']) {
            throw new RuleFailed($this->getMessage());
        }
    }

    protected function getMessage(): string
    {
        return $this->config['message'] ?: self::MESSAGE;
    }
}
