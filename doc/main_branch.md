# Base Branch (main)

To install the **Base Branch**, run the following command in your project directory:

    $ composer require lodel/hello-world-bundle:dev-main

The **Base Branch** provides the essential structure to build custom features for Lodel. It includes key components that you can complete or adjust as needed.

## Files to Complete or Modify

### Configuration files

- [src/Resources/config/packages/lodel_hello_world.yaml](./../src/Resources/config/packages/lodel_hello_world.yaml): Modify the values under `lodel_hello_world` to configure any settings or features specific to your bundle.

- [src/Resources/config/packages/translation.yaml](./../src/Resources/config/packages/translation.yaml): Modify the translation `default_path` and `fallbacks` languages if necessary, depending on where your translations are stored and which fallback languages you want to support.

- [src/Resources/config/packages/twig.yaml](./../src/Resources/config/packages/twig.yaml): Modify the `default_path` if necessary to point to the correct directory where your Twig templates are stored.

- [src/Resources/config/routing.yaml](./../src/Resources/config/routing.yaml): Modify the `resource` path to point to your controller directory and adjust the `type` if necessary to change how routes are defined (e.g., using `annotation` instead of `attribute`).

- [src/Resources/config/services.yaml](./../src/Resources/config/services.yaml): Modify the `_defaults` settings as necessary and replace or remove the service with your own services according to your project needs.

### Translations files

- [src/Resources/translations/*](./../src/Resources/translations): Modify the values under `lodel.hello.world` to customize any text displayed in the application. Those files are used for managing translations to handle multiple languages.

### Configuration structure file

- [src/DependencyInjection/Configuration.php](./../src/DependencyInjection/Configuration.php): This class defines the configuration structure used in the [src/Resources/config/packages/lodel_hello_world.yaml](./../src/Resources/config/packages/lodel_hello_world.yaml) file. Changes should be made inside the ```getConfigTreeBuilder()``` method, specifically within the ```$rootNode->children()``` section, where you add your own configuration options.

### Extension for Service Configuration

- [src/DependencyInjection/HelloWorldExtension.php](./../src/DependencyInjection/HelloWorldExtension.php): Use the `PACKAGES_TO_PREPEND` constant to easily list and manage the packages whose configuration files (in `{name}.yaml` format) are located in the [src/Resources/config/packages/*](./../src/Resources/config/packages) directory, making it simpler to modify the list as needed.
