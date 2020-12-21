<?php

namespace Sieg\ArrayValidator\Tests;

use PHPUnit\Framework\TestCase;
use Sieg\ArrayValidator\Keys;
use Sieg\ArrayValidator\Rule;
use Sieg\ArrayValidator\RuleCase;
use Sieg\ArrayValidator\RuleCaseCollection;

class RuleCaseCollectionTest extends TestCase
{
    public function testGetCasesWithOneRuleCase()
    {
        $collectionItem = new RuleCase(
            new Keys\All(),
            new Rule\Required()
        );

        $collection = new RuleCaseCollection($collectionItem);

        $this->assertSame([$collectionItem], $collection->getCases());
    }
}
