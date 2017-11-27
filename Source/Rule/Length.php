<?php

namespace Sieg\ArrayValidator\Rule;

use Sieg\ArrayValidator\Exception\RuleFailed;

class Length extends AbstractRule
{
    const MESSAGE = 'VALIDATOR_RULE_LENGTH_FAILED';

    public function process($key, $data)
    {
        $this->checkMinOption($data[$key]);
        $this->checkMaxOption($data[$key]);
        $this->checkActualOption($data[$key]);

        return true;
    }

    protected function checkMinOption($item)
    {
        if (isset($this->config['min']) && strlen($item) < $this->config['min']) {
            throw new RuleFailed($this->getMessage());
        }
    }

    protected function checkMaxOption($item)
    {
        if (isset($this->config['max']) && strlen($item) > $this->config['max']) {
            throw new RuleFailed($this->getMessage());
        }
    }

    protected function checkActualOption($item)
    {
        if (isset($this->config['actual']) && strlen($item) !== $this->config['actual']) {
            throw new RuleFailed($this->getMessage());
        }
    }

    /**
     * @return string
     */
    protected function getMessage()
    {
        return $this->config['message'] ?: self::MESSAGE;
    }
}
