# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2023-05-05
### Added
- Interface RequestDataProcessorInterface to pre-process requests data before the main processing of writing 
  operations. This change **BREAKS ALL** the child modules until the dependency injection is resolved. Class 
  `Ebolution\BaseCrudModule\Application\Collaborator\RequestDataProcessor` is offered as placeholder when no 
  particular logic is needed in your module.

## [1.5.3] - 2023-04-28
### Modified
- Update LICENSE and README files

## [1.5.2] - 2023-04-28
### Added
- Return errors as 'errors' on the response

## [1.5.1] - 2023-04-27
### Modified
- Allow modules to override SaveRequest data
- Add try catch to return error messages if exists

## [1.5.0] - 2023-04-23
### Added
- All missing classes to provide full support of CRUD operations by extending them

### Modified
- Structure of the module to 


## [1.0.0] - 2023-03-01
### Added
- This CHANGELOG file to hopefully serve as an evolving example of a
  standardized open source project CHANGELOG.