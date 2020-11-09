# Array Validator

[![Build Status](https://travis-ci.com/Fresh-Advance/array-validator.svg?branch=master)](https://travis-ci.com/Fresh-Advance/array-validator)
[![Coverage Status](https://coveralls.io/repos/github/Sieg/array-validator/badge.svg?branch=master)](https://coveralls.io/github/Sieg/array-validator?branch=master)
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
    use \Sieg\ArrayValidator\Rule;
    use \Sieg\ArrayValidator\Validator;

    $configurationExample = [
        Rule\Required::class => [
            'fields' => ['field1', 'field2', 'field3']
        ],
        Rule\Expression::class => [
            [
                'fields' => ['field1', 'field3'],
                'pattern' => '/value\d+/'
            ],
            [
                'fields' => ['field2'],
                'pattern' => '/Value/i',
                'message' => 'super message'
            ]
        ]
    ];
    
    $dataExample = [
         'field1' => 'value1',
         'field2' => 'something'
     ];
     
     $validator = new Validator($configurationExample);
     if ($validator->isValid($dataExample)) {
        // array fits validation configuration
     } else {
        print_r($validator->getErrors());
     }
```

## Predefined Rules

There are some basic rules implemented with the component.

Every rule options:

* **fields** - String[]

    List of keys in array to apply rule on.
    
* **message** - String

    Error message for failing validation field.

### Required Rule

Rule checks if key exists in array and is not null.

### Expression Rule

Rule checks the value to match specific regular expression pattern.

Parameters:
* **pattern** - String
    
    Regular expression pattern to check fields against

### Equals Rule

Rule checks the value to match specific regular expression pattern.

Parameters:
* **key** - String
    
    If option is set, the rule will check if field value matches another field value
    
* **value** - String

    If option is set, the rule will check if field value matches the option value

### Callback Rule

Runs some closure and throws a message if closure fails.

Parameters:
* **callback** - Closure with parameters: $key, $data.
    
    Regular expression pattern to check fields against

### Length Rule

Rule checks a length of the value.

Parameters:
* **min** - Integer
    
    If option is set, the rule will check if value length is at least **min** symbols.
    
* **max** - Integer
    
    If option is set, the rule will check if value length is maximum **max** symbols.

* **actual** - Integer
    
    If option is set, the rule will check if value length is **actual** symbols.

### Filter Rule

Rule uses filter_var method for validating the value.

Refer to filter_var method documentation for more information: http://php.net/manual/en/function.filter-var.php

Parameters:
* **rule** - one of PHP filter constants to apply
    
    Supported rules:
        
        * FILTER_VALIDATE_EMAIL
        * FILTER_VALIDATE_FLOAT
        * FILTER_VALIDATE_INT
        * FILTER_VALIDATE_IP
        * FILTER_VALIDATE_MAC
        * FILTER_VALIDATE_REGEXP
        * FILTER_VALIDATE_URL

* **options** - Array
    
    Sent to filter_var method as "options" argument.


## Create and use custom Rules

* Custom rule should extend ``\Sieg\ArrayValidator\Rule\AbstractRule``
* Use it as regular rules whose comes with the component.
* Validator catches ``\Sieg\ArrayValidator\Exception\RuleFailed`` type Exceptions for setting field error messages.