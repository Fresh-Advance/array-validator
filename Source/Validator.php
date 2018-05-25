<?php

namespace Sieg\ArrayValidator;

use Sieg\ArrayValidator\Exception\RuleFailed;
use Sieg\ArrayValidator\Rule\AbstractRule;

class Validator
{
    /** @var array $rules */
    protected $rules;

    /** @var array $errors */
    protected $errors = [];

    /** @var bool $validationStatus */
    protected $validationStatus = true;

    /**
     * Validator constructor.
     *
     * @var array
     */
    public function __construct($validationRules = [])
    {
        $this->rules = $validationRules;
    }

    /**
     * Main validator action to start validation process.
     *
     * @param array $data
     *
     * @return bool
     */
    public function isValid($data)
    {
        $this->errors = [];
        $this->validationStatus = true;

        foreach ($this->rules as $ruleClass => $ruleConfiguration) {
            $this->processRule($data, $ruleConfiguration, $ruleClass);
        }

        return $this->validationStatus;
    }

    /**
     * @param $data
     * @param $ruleConfiguration
     * @param $ruleClass
     */
    protected function processRule($data, $ruleConfiguration, $ruleClass)
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
     * @param $data
     * @param $ruleConfiguration
     * @param $ruleClass
     */
    protected function processRuleConfiguration($data, $ruleConfiguration, $ruleClass)
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
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Get configuration of specific rule
     *
     * @param string $key
     *
     * @return array
     */
    public function getRule($key)
    {
        $result = isset($this->rules[$key]) ? $this->rules[$key] : [];

        return $result;
    }

    /**
     * Set configuration of specific rule
     *
     * @param string $key
     * @param array $configuration
     */
    public function setRule($key, $configuration)
    {
        $this->rules[$key] = $configuration;
    }

    /**
     * Appends additional configuration to specific rule
     *
     * @param string $key
     * @param array $configuration
     */
    public function addRule($key, $configuration)
    {
        $currentValue = $this->getRule($key);
        if (array_key_exists('fields', $currentValue)) {
            $currentValue = [$currentValue];
        }
        $currentValue[] = $configuration;

        $this->setRule($key, $currentValue);
    }
}
