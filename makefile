EXEC_COMPOSER = composer
EXEC_CONSOLE = php bin/console
EXEC_DEPTRAC = deptrac
EXEC_SYMFONY = symfony
EXEC_VENDOR = vendor/bin

## 
## Project
## 

install: ## Install the project
install: vendor

run: ## Run the project
run: vendor
	$(EXEC_SYMFONY) serve

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
test: vendor
	$(EXEC_VENDOR)/phpstan analyse src --memory-limit 0
	$(EXEC_DEPTRAC) --fail-on-uncovered
	$(EXEC_VENDOR)/phpunit

coverage: ## Run all tests with code coverage
coverage: vendor
	$(EXEC_VENDOR)/phpunit --coverage-html var/report

.PHONY: test coverage

# rules based on files

vendor: composer.lock
	$(EXEC_COMPOSER) install
	@touch --no-create vendor


# generate help
.DEFAULT_GOAL := help
help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
.PHONY: help