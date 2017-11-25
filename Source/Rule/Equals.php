<?php

namespace Sieg\ArrayValidator\Rule;

use Sieg\ArrayValidator\Exception\RuleFailed;

class Equals extends AbstractRule
{
    const MESSAGE = 'VALIDATOR_RULE_EQUALS_MATCH_FAILED';

    public function process($key, $data)
    {
        $message = $this->config['message'] ?: self::MESSAGE;

        if (!isset($data[$key])) {
            throw new RuleFailed($message);
        }

        $this->checkKeyOption($key, $data, $message);
        $this->checkValueOption($key, $data, $message);

        return true;
    }

    /**
     * @param string $key
     * @param array $data
     * @param string $message
     *
     * @throws RuleFailed
     */
    protected function checkKeyOption($key, $data, $message)
    {
        if (isset($this->config['key']) &&
            (!isset($data[$this->config['key']]) || $data[$key] !== $data[$this->config['key']])
        ) {
            throw new RuleFailed($message);
        }
    }

    /**
     * @param string $key
     * @param array $data
     * @param string $message
     *
     * @throws RuleFailed
     */
    protected function checkValueOption($key, $data, $message)
    {
        if (isset($this->config['value']) && $data[$key] !== $this->config['value']) {
            throw new RuleFailed($message);
        }
    }
}
