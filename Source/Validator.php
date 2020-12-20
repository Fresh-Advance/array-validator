<?php

namespace Sieg\ArrayValidator;

use Sieg\ArrayValidator\Exception\RuleFailed;
use Sieg\ArrayValidator\Rule\AbstractRule;

class Validator
{
    /** @var RuleCaseCollection */
    protected $validationRules;

    public function __construct(RuleCaseCollection $validationRules)
    {
        $this->validationRules = $validationRules;
    }

    /**
     * Main validator action to start validation process.
     * Return array with errors list grouped by field.
     *
     * @param mixed[] $data
     *
     * @return mixed[]
     */
    public function validate(array $data): array
    {
        $errors = [];
        $cases = $this->validationRules->getCases();

        foreach ($cases as $oneCase) {
            $ruleErrors = $this->processRuleCase($oneCase, $data);

            foreach ($ruleErrors as $oneField => $fieldError) {
                $errors[$oneField][] = $fieldError;
            }
        }

        return $errors;
    }

    /**
     * @param mixed[] $data
     *
     * @return string[]
     */
    protected function processRuleCase(RuleCase $ruleCase, array $data): array
    {
        $fields = $ruleCase->filterFields(array_keys($data));
        $rule = $ruleCase->getRule();
        $errors = [];

        foreach ($fields as $oneField) {
            try {
                $rule->process($oneField, $data);
            } catch (RuleFailed $exception) {
                $specialMessage = $ruleCase->getMessage();
                $errors[$oneField] = $specialMessage ? $specialMessage : $exception->getMessage();
            }
        }

        return $errors;
    }
}
