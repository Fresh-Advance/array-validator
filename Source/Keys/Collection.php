<?php

namespace Sieg\ArrayValidator\Keys;

class Collection implements KeyFilterInterface
{
    private array $fieldsList;

    public function __construct(string ...$list)
    {
        $this->fieldsList = $list;
    }

    public function filter(array $keys): array
    {
        $intersection = array_intersect($keys, $this->fieldsList);
        return array_values($intersection);
    }
}
