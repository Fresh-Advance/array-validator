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
    public function validate($data)
    {
        $validationResult = true;
        $this->errors = [];

        foreach ($this->rules as $ruleClass => $ruleConfiguration) {
            foreach ($ruleConfiguration['fields'] as $fieldName) {
                try {
                    /** @var AbstractRule $rule */
                    $rule = new $ruleClass($ruleConfiguration);
                    $rule->process($fieldName, $data);
                } catch (RuleFailed $exception) {
                    $this->errors[$fieldName][] = $exception->getMessage();
                    $validationResult = false;
                }
            }
        }

        return $validationResult;
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
}
