# Change Log for Array Validator component

All notable changes to this project will be documented in this file.
The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [v2.2.0] - 2021-02-06

### Added
- More test cases
- PHP8 supported

## [v2.1.1] - 2020-12-24

### Fixed
- Fix usage example in readme

## [v2.1.0] - 2020-12-24

### Added
- InArray rule
- Min rule
- Max rule
- Range rule

## [v2.0.0] - 2020-12-22

### Added
- A possibility to more precisely specify the list of fields for a rule.

### Changed
- Changed the way how to configure the validator
- Validation state is not saved in Validator object anymore
- ``isValid`` method renamed to ``validate``, which always return errors array
- Vendor renamed to fresh-advance
- Improved readme with installation instructions and new way to configure
- All rule constructors now takes more strict and intuitive parameters

## [v1.0.0] - 2018-05-24

Very basic implementation. Tested for a while, stable version.

### Added
- Implemented rules (See README.md for more information):
    * Required
    * Expression
    * Equals
    * Callback
    * Length
    * Filter


[v2.2.0]: https://github.com/Sieg/array-validator/compare/v2.1.1...v2.2.0
[v2.1.1]: https://github.com/Sieg/array-validator/compare/v2.1.0...v2.1.1
[v2.1.0]: https://github.com/Sieg/array-validator/compare/v2.0.0...v2.1.0
[v2.0.0]: https://github.com/Sieg/array-validator/compare/v1.0.0...v2.0.0
[v1.0.0]: https://github.com/Sieg/array-validator/compare/3778b8fe...v1.0.0