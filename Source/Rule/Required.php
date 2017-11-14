<?php

namespace Sieg\ArrayValidator\Rule;

use Sieg\ArrayValidator\Exception\RuleFailed;

class Required extends AbstractRule
{
    public function process($key, $data)
    {
        $message = $this->config['message'] ?: "Value required.";

        if (!isset($data[$key]) or $data[$key] === null or $data[$key] === "") {
            throw new RuleFailed($message);
        }

        return true;
    }
}
