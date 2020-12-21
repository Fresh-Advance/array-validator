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

    public function getCases()
    {
        return $this->ruleCaseList;
    }
}
