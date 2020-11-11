<?php

namespace Sieg\ArrayValidator\Rule;

use Sieg\ArrayValidator\Exception\RuleFailed;

class Callback extends AbstractRule
{
    public const MESSAGE = 'VALIDATOR_RULE_CALLBACK_FAILED';

    /**
     * @param mixed[] $data
     */
    public function process(string $key, array $data): bool
    {
        $message = $this->config['message'] ?: self::MESSAGE;
        $function = $this->config['callback'];

        if (!$function($key, $data)) {
            throw new RuleFailed($message);
        }

        return true;
    }
}
