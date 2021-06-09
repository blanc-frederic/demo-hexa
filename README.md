# Hexagonal architecture with Symfony

Hexagonal architecture implementation example

Used during "L'architecture hexagonale... concrètement" conference on AFUP Day, June 11th 2021

[Conference slides (fr)](https://blanc-frederic.github.io/talks/2021-06-11_Hexagonal)

## Getting Started

### Prerequisites

- PHP 7.4+
- Composer

#### Optionals

- [Deptrac](https://github.com/qossmic/deptrac#installation) for dependencies check
- Xdebug or similar for code coverage
- Symfony exe for local development

### Installing

    make install

## Running tests

For full tests chain : static analysis, dependencies checks and tests

    make test

For running only unit tests

    vendor/bin/phpunit

### Code coverage

    make coverage

Reports will be available in var/report/index.html

## Running locally

    symfony serve

## Authors

  - **Fred Blanc**
    [GitHub](https://github.com/blanc-frederic)
