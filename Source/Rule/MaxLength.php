<?php

namespace Sieg\ArrayValidator\Rule;

use Sieg\ArrayValidator\Exception\RuleFailed;

class MaxLength extends AbstractRule
{
    public const MESSAGE = 'VALIDATOR_RULE_LENGTH_TOO_HIGH';

    /** @var int */
    private $max;

    public function __construct(int $max)
    {
        $this->max = $max;
    }

    /**
     * @param mixed[] $data
     */
    public function process(string $key, array $data): bool
    {
        if (!isset($data[$key]) || strlen($data[$key]) > $this->max) {
            throw new RuleFailed(self::MESSAGE);
        }

        return true;
    }
}
