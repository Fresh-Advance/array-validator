<?php

namespace Sieg\ArrayValidator;

use Sieg\ArrayValidator\Exception\RuleFailed;
use Sieg\ArrayValidator\Rule\AbstractRule;

class Validator
{
    /** @var array[] $rules */
    protected $rules;

    /** @var array[] $errors */
    protected $errors = [];

    /** @var bool $validationStatus */
    protected $validationStatus = true;

    /**
     * Validator constructor.
     *
     * @param mixed[] $validationRules
     */
    public function __construct(array $validationRules = [])
    {
        $this->rules = $validationRules;
    }

    /**
     * Main validator action to start validation process.
     *
     * @param mixed[] $data
     */
    public function isValid(array $data): bool
    {
        $this->errors = [];
        $this->validationStatus = true;

        foreach ($this->rules as $ruleClass => $ruleConfiguration) {
            $this->processRule($data, $ruleConfiguration, $ruleClass);
        }

        return $this->validationStatus;
    }

    /**
     * @param array[] $data
     * @param array[] $ruleConfiguration
     * @param string $ruleClass
     */
    protected function processRule(array $data, array $ruleConfiguration, string $ruleClass): void
    {
        if (array_key_exists('fields', $ruleConfiguration)) {
            $this->processRuleConfiguration($data, $ruleConfiguration, $ruleClass);
        } else {
            foreach ($ruleConfiguration as $ruleSubConfiguration) {
                $this->processRuleConfiguration($data, $ruleSubConfiguration, $ruleClass);
            }
        }
    }

    /**
     * @param array[] $data
     * @param array[] $ruleConfiguration
     * @param string $ruleClass
     */
    protected function processRuleConfiguration(array $data, array $ruleConfiguration, string $ruleClass): void
    {
        foreach ($ruleConfiguration['fields'] as $fieldName) {
            try {
                /** @var AbstractRule $rule */
                $rule = new $ruleClass($ruleConfiguration);
                $rule->process($fieldName, $data);
            } catch (RuleFailed $exception) {
                $this->errors[$fieldName][] = $exception->getMessage();
                $this->validationStatus = false;
            }
        }
    }

    /**
     * Returns validation errors list
     *
     * @return array[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Get configuration of specific rule
     *
     * @return array[]
     */
    public function getRule(string $key): array
    {
        return isset($this->rules[$key]) ? $this->rules[$key] : [];
    }

    /**
     * Set configuration of specific rule
     *
     * @param mixed[] $configuration
     */
    public function setRule(string $key, array $configuration): void
    {
        $this->rules[$key] = $configuration;
    }

    /**
     * Appends additional configuration to specific rule
     *
     * @param mixed[] $configuration
     */
    public function addRule(string $key, array $configuration): void
    {
        $currentValue = $this->getRule($key);
        if (array_key_exists('fields', $currentValue)) {
            $currentValue = [$currentValue];
        }
        $currentValue[] = $configuration;

        $this->setRule($key, $currentValue);
    }
}
