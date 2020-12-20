<?php

namespace Sieg\ArrayValidator\Keys;

use Sieg\ArrayValidator\Exception\FieldsListError;

class Expression implements KeyFilterInterface
{
    /** @var string */
    private $expression;

    public function __construct(string $expression)
    {
        if (!$expression || @preg_match($expression, null) === false) {
            throw new FieldsListError('Expression is not correct');
        }

        $this->expression = $expression;
    }

    public function filter(array $keys): array
    {
        $result = [];

        foreach ($keys as $oneKey) {
            if (preg_match($this->expression, $oneKey)) {
                $result[] = $oneKey;
            }
        }

        return $result;
    }
}
