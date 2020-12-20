<?php

namespace Sieg\ArrayValidator\Rule;

use Sieg\ArrayValidator\Exception\RuleFailed;

interface RuleInterface
{
    /**
     * @param mixed[] $data
     *
     * @throws RuleFailed
     */
    public function process(string $key, array $data): bool;
}
