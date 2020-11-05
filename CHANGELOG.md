# Change Log for Array Validator component

All notable changes to this project will be documented in this file.
The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [v2.0.0] - Unreleased

### Added

- New methods:
    * Validator::getRule - get configurations of specific rule
    * Validator::setRule - set configuration of specific rule
    * Validator::addRule - append additional configuration to specific rule

## [v1.0.0] - 2018-05-24

Tested for a while, stable version.

### Added

- Implemented rules (See README.md for more information):
    * Required
    * Expression
    * Equals
    * Callback
    * Length
    * Filter


[v2.0.0]: https://github.com/Sieg/array-validator/compare/v1.0.0...HEAD
[v1.0.0]: https://github.com/Sieg/array-validator/compare/3778b8fe...v1.0.0