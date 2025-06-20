<?php

declare(strict_types=1);

namespace Lodel\HelloWorldBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration.
 *
 * This class defines the configuration structure for the LodelHelloWorldBundle.
 * It is used by Symfony to validate and normalize configuration values provided
 * in the application's configuration files (e.g., YAML, XML, or PHP).
 *
 * The configuration structure defines the root node and available options, which
 * can be used to configure the behavior of the HelloWorldBundle.
 */
class Configuration implements ConfigurationInterface
{
    /**
     * The alias used as the root key in configuration files (e.g., `lodel_hello_world`).
     */
    private const ALIAS = 'lodel_hello_world';

    /**
     * Builds the configuration tree for the bundle.
     *
     * This method defines the hierarchical structure of the configuration options
     * available in the `lodel_hello_world` namespace and provides validation rules.
     * The configuration tree allows users to define values such as the 'hello' option
     * with predefined rules and default values.
     *
     * Users can define custom configuration options under this root node, such as:
     * - 'hello' (default: 'world')
     * Additional configuration options can be added here as needed.
     *
     * ### Example of configuration:
     * The following YAML configuration defines the `hello` parameter:
     *
     * ```yaml
     * lodel_hello_world:
     *     hello: world
     * ```
     *
     * @return TreeBuilder The tree builder defining the bundle's configuration
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder(self::ALIAS); // Define the root configuration namespace

        $rootNode = $treeBuilder->getRootNode(); // Get the root node of the configuration tree

        // Define the structure of the configuration
        // This is where you'd add configuration options, validation rules, and default values
        // For example:
        $rootNode
            ->children() // Configuration options
                // ### Modify or remove this example configuration as needed for your own bundle
                ->scalarNode('hello') // Example configuration for 'hello' option
                    ->defaultValue('world') // Default value for 'hello'
                    ->info('This option defines the greeting message. The default value is "world", but you can change it to any other string as needed.') // Info about the 'hello' option
                ->end() // End of 'hello' configuration example
                // ### End of 'hello' configuration example
            ->end() // End of configuration options
        ;

        // Returning the tree builder allows Symfony to validate the structure defined here
        return $treeBuilder;
    }
}
