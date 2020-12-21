<?php

namespace Sieg\ArrayValidator\Rule;

use Sieg\ArrayValidator\Exception\RuleFailed;

class Length extends AbstractRule
{
    public const MESSAGE = 'VALIDATOR_RULE_LENGTH_FAILED';

    private $min;
    private $max;
    private $actual;

    public function __construct(int $min = null, int $max = null, int $actual = null)
    {
        $this->min = $min;
        $this->max = $max;
        $this->actual = $actual;
    }

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
        if (!is_null($this->min) && strlen($item) < $this->min) {
            throw new RuleFailed(self::MESSAGE);
        }
    }

    /**
     * @param mixed $item
     *
     * @throws RuleFailed
     */
    protected function checkMaxOption($item): void
    {
        if (!is_null($this->max) && strlen($item) > $this->max) {
            throw new RuleFailed(self::MESSAGE);
        }
    }

    /**
     * @param mixed $item
     *
     * @throws RuleFailed
     */
    protected function checkActualOption($item): void
    {
        if (!is_null($this->actual) && strlen($item) !== $this->actual) {
            throw new RuleFailed(self::MESSAGE);
        }
    }
}
