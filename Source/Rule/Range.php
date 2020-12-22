<?php

namespace Sieg\ArrayValidator\Rule;

class Range extends AbstractRule
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
        (new Min($this->min))->process($key, $data);
        (new Max($this->max))->process($key, $data);

        return true;
    }
}
