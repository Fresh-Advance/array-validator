<?php

namespace Sieg\ArrayValidator;

use Sieg\ArrayValidator\Keys\KeyFilterInterface;
use Sieg\ArrayValidator\Rule\RuleInterface;

class RuleCase
{
    protected KeyFilterInterface $keyFilter;
    protected RuleInterface $rule;
    protected $message;

    public function __construct(
        KeyFilterInterface $keyFilter,
        RuleInterface $rule,
        string $message = null
    ) {
        $this->keyFilter = $keyFilter;
        $this->rule = $rule;
        $this->message = $message;
    }

    /**
     * @param string[] $fieldsList
     * @return string[]
     */
    public function filterFields(array $fieldsList): array
    {
        return $this->keyFilter->filter($fieldsList);
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function getRule(): RuleInterface
    {
        return $this->rule;
    }
}
