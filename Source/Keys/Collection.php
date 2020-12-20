<?php

namespace Sieg\ArrayValidator\Keys;

class Collection implements KeyFilterInterface
{
    /** @var string[] */
    private $fieldsList;

    public function __construct(string ...$list)
    {
        $this->fieldsList = $list;
    }

    public function filter(array $keys): array
    {
        return $this->fieldsList;
    }
}
