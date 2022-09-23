# Hexagonal architecture with Symfony

Hexagonal architecture implementation example

Used during "L'architecture hexagonale... concrètement" conference on AFUP Day, June 11th 2021

[Conference slides (fr)](https://blanc-frederic.github.io/talks/2021-06-11_Hexagonal)

## Getting Started

### Prerequisites

- Docker

### Installing

    make install

## Running tests

For full tests chain : static analysis, dependencies checks and tests

    make test

For running only unit tests

    docker compose run tests

### Code coverage

    make coverage

Reports will be available in var/report/index.html

## Authors

  - **Fred Blanc**
    [GitHub](https://github.com/blanc-frederic)
