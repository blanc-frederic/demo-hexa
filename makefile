EXEC_COMPOSER = docker compose run composer
EXEC_CONSOLE = docker compose run console
EXEC_DEPTRAC = docker compose run deptrac
EXEC_TESTS = docker compose run tests

## 
## Project
## 

install: ## Install the project
install: vendor var/data

run: ## Run the project
run: vendor var/data

.PHONY: install run

## 
## Utils
## 

check: ## Launch all checks & lints
check: vendor
	$(EXEC_COMPOSER) validate
	$(EXEC_CONSOLE) lint:container
	$(EXEC_CONSOLE) lint:yaml config

.PHONY: check

## 
## Tests
## 

test: ## Run all tests
test: vendor var/data
	$(EXEC_COMPOSER) phpstan
	$(EXEC_DEPTRAC) --report-uncovered --fail-on-uncovered
	$(EXEC_TESTS) --testsuite full

coverage: ## Run all tests with code coverage
coverage: vendor var/data
	$(EXEC_TESTS) --testsuite full --coverage-html var/report

.PHONY: test coverage

# rules based on files

vendor: composer.lock
	$(EXEC_COMPOSER) install
	@touch --no-create vendor

var/data:
	$(EXEC_CONSOLE) app:fixtures:load


# generate help
.DEFAULT_GOAL := help
help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
.PHONY: help