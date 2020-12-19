<?php

namespace Sieg\ArrayValidator\Keys;

interface KeyFilterInterface
{
    /**
     * @param string[] $keys
     * @return string[]
     */
    public function filter(array $keys): array;
}
