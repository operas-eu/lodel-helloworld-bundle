# Lodel Hello World Bundle

_Starter bundle for Lodel 2.0 — Quickly create custom extensions._

## Introduction

The HelloWorldBundle is a starter bundle designed to help developers create custom extensions for the Lodel 2.0 platform. It provides basic features and setup for adding new functionality to Lodel 2.0, similar to plugin systems in other CMS platforms, allowing quick implementation of features specific to each installation.

This bundle is developed as part of the CRAFT-OA Project (https://www.craft-oa.eu/) funded by the European Union (HORIZON-INFRA-2022-EOSC-01 Grant Agreement: 101094397). It aims to support interoperability and transformation workflows in scholarly publishing.

⚠️ **This bundle requires Lodel 2.0 (which may not yet be available)**. For more information, visit: [Lodel 2.0 Announcement](https://leo.hypotheses.org/22760) ⚠️

📅 _Last updated: June 17, 2025_

## Installation

To get started with the HelloWorldBundle, clone the repository or install it as a dependency, then enable the bundle in your Lodel project.

For detailed steps, check the [Installation Guide](docs/installation.md).

## Code Documentation

This bundle uses Doxygen to generate code documentation. Doxygen reads through PHPDoc comments to produce an organized and browsable HTML documentation.

See [Documentation](docs/documentation.md) for more details.

## Branches and Examples

The repository is organized into several branches to provide different levels of customization:

- [Base Branch (main)](docs/branches/main_branch.md): This branch contains the bare minimum setup needed for a developer to get started with creating their own features. It includes the necessary structure and configuration to integrate your code into the Lodel 2.0 platform.

- [Example/Scenario Branches (feature/*)](docs/branches/feature/feature_branches.md): These branches contain a series of practical examples and scenarios that demonstrate how to implement common features and use cases using the HelloWorldBundle. They serve as guides for developers, showing real-world implementations of the bundle in action.

## Testing

This bundle includes a basic test suite to ensure that core functionality works as expected.

See [Testing](docs/testing.md) for tips on running tests.

## Quality

For detailed information on how to check the code quality, please refer to the [Quality Checks](docs/quality.md).

## Security

For detailed information on how to check the security of the project, please refer to the [Security Checks](docs/security.md).

## Continuous Integration

This project uses [GitHub Actions](https://github.com/features/actions) for continuous integration.

Each commit and pull request triggers an automated workflow that checks code formatting, performs static analysis, and validates YAML configuration files

This helps ensure code quality and prevents regressions early in the development process.

See the [ci.yaml](.github/workflows/ci.yaml) file for details.

⚠️ To allow the CI to run successfully even though Lodel 2.0 is not yet publicly available, the workflow includes temporary blocks and placeholder code. These parts are clearly marked within the CI script and will need to be removed once Lodel 2.0 is released and installable via Composer.

## License

This project is licensed under the GNU General Public License v3.0.

See the [LICENSE](LICENSE) file for details.
