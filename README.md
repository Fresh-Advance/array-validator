# Array Validator

[![Build Status](https://travis-ci.org/Sieg/array-validator.svg?branch=master)](https://travis-ci.org/Sieg/array-validator)
[![Coverage Status](https://coveralls.io/repos/github/Sieg/array-validator/badge.svg?branch=master)](https://coveralls.io/github/Sieg/array-validator?branch=master)
[![Packagist](https://img.shields.io/packagist/v/sieg/array-validator.svg)](https://packagist.org/packages/sieg/array-validator)

* Component validates an array by provided rules list. 
* Its possible to use multiple configurations of one rule for one validation.

## Usage example

```php
    $configurationExample = [
        \Sieg\ArrayValidator\Rule\Required::class => [
            'fields' => ['field1', 'field2', 'field3']
        ],
        \Sieg\ArrayValidator\Rule\Expression::class => [
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
     
     $validator = new \Sieg\ArrayValidator\Validator($configurationExample);
     if ($validator->isValid($data)) {
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

## Create and use custom Rules

* Custom rule should extend ``\Sieg\ArrayValidator\Rule\AbstractRule``
* Use it as regular rules whose comes with the component.
* Validator catches ``\Sieg\ArrayValidator\Exception\RuleFailed`` type Exceptions for setting field error messages.