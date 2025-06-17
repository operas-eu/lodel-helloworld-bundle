# Target for checking code quality using PHP-CS-Fixer and PHPStan
quality:
	# Runs YAML linting to validate configuration file syntax
	vendor/bin/yaml-lint src/
	# Runs PHP-CS-Fixer to fix coding standard violations in the codebase
	vendor/bin/php-cs-fixer fix
	# Runs PHPStan to analyze the code for potential errors and issues
	vendor/bin/phpstan analyse
# .PHONY tells make that 'quality' is not a file, it's a target
.PHONY: quality

# Target for checking security issues using Symfony's security check
security:
	# Runs Symfony's security:check command to check for known vulnerabilities
	# '--no-interaction' ensures no prompts are shown during the check
	symfony security:check --no-interaction
# .PHONY tells make that 'security' is not a file, it's a target
.PHONY: security

# Target for running tests with PHPUnit and generating code coverage reports
tests:
	# Runs PHPUnit to execute tests and generates:
	# - an HTML report in 'build/coverage-html'
	# - a Clover XML report in 'build/coverage.xml'
	XDEBUG_MODE=coverage vendor/bin/phpunit
.PHONY: tests
