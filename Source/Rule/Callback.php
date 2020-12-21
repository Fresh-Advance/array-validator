<?php

namespace Sieg\ArrayValidator\Rule;

use Sieg\ArrayValidator\Exception\RuleFailed;

class Callback extends AbstractRule
{
    public const MESSAGE = 'VALIDATOR_RULE_CALLBACK_FAILED';

    private $callback;

    public function __construct($callback)
    {
        $this->callback = $callback;
    }

    /**
     * @param mixed[] $data
     */
    public function process(string $key, array $data): bool
    {
        $function = $this->callback;

        if (!$function($key, $data)) {
            throw new RuleFailed(self::MESSAGE);
        }

        return true;
    }
}
