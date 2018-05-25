# Change Log for Array Validator component

All notable changes to this project will be documented in this file.
The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]

* Validator got some power to manipulate rules directly, but not just through initialization configuration.

New methods:
* getRule - get configurations of specific rule
* setRule - set configuration of specific rule
* addRule - append additional configuration to specific rule

## [v1.0.0] - 2018-05-24

Tested for a while, stable version.

Implemented rules:
* Required
* Expression
* Equals
* Callback
* Length
* Filter

See README.md for more information.

[Unreleased]: https://github.com/Sieg/array-validator/compare/v1.0.0...HEAD
[v1.0.0]: https://github.com/Sieg/array-validator/compare/3778b8fe...v1.0.0