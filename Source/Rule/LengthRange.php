<?php

namespace Sieg\ArrayValidator\Rule;

use Sieg\ArrayValidator\Exception\RuleFailed;

class LengthRange extends AbstractRule
{
    /** @var int */
    private $min;

    /** @var int */
    private $max;

    public function __construct(int $min, int $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @param mixed[] $data
     */
    public function process(string $key, array $data): bool
    {
        (new MinLength($this->min))->process($key, $data);
        (new MaxLength($this->max))->process($key, $data);

        return true;
    }
}
