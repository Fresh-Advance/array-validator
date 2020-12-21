<?php

namespace Sieg\ArrayValidator;

class RuleCaseCollection
{
    /** @var RuleCase[] */
    private $ruleCaseList;

    public function __construct(RuleCase ...$ruleCaseList)
    {
        $this->ruleCaseList = $ruleCaseList;
    }

    /**
     * @return RuleCase[]
     */
    public function getCases(): array
    {
        return $this->ruleCaseList;
    }
}
