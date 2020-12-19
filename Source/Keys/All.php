<?php

namespace Sieg\ArrayValidator\Keys;

class All implements KeyFilterInterface
{
    public function filter(array $keys): array
    {
        return $keys;
    }
}
