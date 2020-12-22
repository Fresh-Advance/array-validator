# Array Validator

[![Build Status](https://travis-ci.com/Fresh-Advance/array-validator.svg?branch=master)](https://travis-ci.com/Fresh-Advance/array-validator)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=Fresh-Advance_array-validator&metric=alert_status)](https://sonarcloud.io/dashboard?id=Fresh-Advance_array-validator)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=Fresh-Advance_array-validator&metric=coverage)](https://sonarcloud.io/dashboard?id=Fresh-Advance_array-validator)
[![Technical Debt](https://sonarcloud.io/api/project_badges/measure?project=Fresh-Advance_array-validator&metric=sqale_index)](https://sonarcloud.io/dashboard?id=Fresh-Advance_array-validator)
[![Packagist](https://img.shields.io/packagist/v/fresh-advance/array-validator.svg)](https://packagist.org/packages/fresh-advance/array-validator)

Simple form data / any array validation tool.

* Component validates an array by provided rules list. 
* Its possible to use multiple configurations of one rule for one field in one validation run.

## Installation

Installation via composer:

```
composer require fresh-advance/array-validator
```

## Usage example

```php
use Sieg\ArrayValidator\Keys;
use Sieg\ArrayValidator\Rule;
use Sieg\ArrayValidator\RuleCase;
use Sieg\ArrayValidator\RuleCaseCollection;
use Sieg\ArrayValidator\Validator;

$configurationExample = new RuleCaseCollection(
    new RuleCase(
        new Keys\All(),
        new Rule\Length(5, 7)
    ),
    new RuleCase(
        new Keys\Collection('field1', 'field3'),
        new Rule\Expression('/value\d+/')
    ),
    new RuleCase(
        new Keys\Expression('/2$/'),
        new Rule\Expression('/value\d+/'),
        'Special message'
    )
);

$dataExample = [
    'field1' => 'value1',
    'field2' => 'something'
];

$validator = new Validator($configurationExample);
$errors = $validator->validate($dataExample);
if (empty($errors)) {
    // array fits validation configuration
    echo 'ok';
} else {
    print_r($errors);
}
```

Gives validation errors with fields as keys:

```
Array
(
    [field2] => Array
        (
            [0] => VALIDATOR_RULE_LENGTH_FAILED
            [1] => Special message
        )

    [field3] => Array
        (
            [0] => VALIDATOR_RULE_EXPRESSION_MATCH_FAILED
        )
)
```

## Predefined Rules

There are some basic rules implemented with the component:

* **Callback(closure $closure)**
  - Takes Closure as parameter. **$key** and **$data** will be sent to Closure.

* **EqualsTo(mixed $value)**
  - Check if value is equal to Rule $value parameter.

* **EqualsToKey(string $key)**
  - Check if value is equal to other key value.

* **Expression(string $regex)**
  - Takes regex as parameter.

* **Filter(int $filterRule, array $filterOptions)**
  - Rule uses ``filter_var`` function for validating the value.
  - Takes PHP filter constants to apply as first param:
    * FILTER_VALIDATE_EMAIL
    * FILTER_VALIDATE_FLOAT
    * FILTER_VALIDATE_INT
    * FILTER_VALIDATE_IP
    * FILTER_VALIDATE_MAC
    * FILTER_VALIDATE_REGEXP
    * FILTER_VALIDATE_URL
  - Takes ``filter_var`` options array as second param.
  - Refer to ``filter_var`` function documentation for more [information](http://php.net/manual/en/function.filter-var.php)

* **InArray(array $choices)**

* **Length(int $length)**
* **LengthRange(int $min, int $max)**
* **MaxLength(int $max)**
* **MinLength(int $min)**

* **Required**
  - Check if the field exists and not empty

## Create and use custom Rules

* Custom rule should extend ``\Sieg\ArrayValidator\Rule\AbstractRule``
* Use it as regular rules whose comes with the component.
* Validator catches ``\Sieg\ArrayValidator\Exception\RuleFailed`` type Exceptions for setting field error messages.