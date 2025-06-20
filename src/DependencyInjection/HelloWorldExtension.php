<?php

declare(strict_types=1);

namespace Lodel\HelloWorldBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Yaml\Yaml;

/**
 * Class HelloWorldExtension.
 *
 * This class is the custom extension for the HelloWorldBundle. It is responsible for:
 * - Loading and processing the bundle's configuration.
 * - Defining parameters and services in the Symfony Dependency Injection container.
 * - Prepending configuration to other bundles, if needed.
 */
class HelloWorldExtension extends Extension implements PrependExtensionInterface
{
    /**
     * The alias used as the root key in configuration files (e.g., `lodel_hello_world`).
     * This is also the name used to reference parameters and services related to this bundle.
     */
    private const ALIAS = 'lodel_hello_world';

    /**
     * List of packages to prepend configuration for.
     */
    private const PACKAGES_TO_PREPEND = [
        self::ALIAS, // The configuration package for this bundle
        'translation', // The configuration package related to translation services
        'twig', // The configuration package for Twig
    ];

    /**
     * Loads and manages bundle configuration.
     *
     * This method is invoked during the container compilation process to:
     * - Load service definitions from YAML files.
     * - Process and validate bundle-specific configuration.
     * - Register parameters into the container.
     *
     * @param array            $configs   An array of configuration values defined by the user
     *                                    in their configuration files (e.g., YAML, PHP).
     * @param ContainerBuilder $container the container to which service definitions and parameters are added
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        // Create a loader for YAML configuration files
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        // Load the services definition from 'services.yaml'
        $loader->load('services.yaml');

        // Process the bundle's configuration using the Configuration class
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        // Register the processed configuration in the container as a parameter
        $container->setParameter(self::ALIAS, $config);
    }

    /**
     * Prepend configuration to other bundles.
     *
     * This method is used to add or modify configuration for other bundles before their extensions are processed.
     * Here, it reads and prepends configurations from YAML files located in the `packages/` directory.
     *
     * @param ContainerBuilder $container the container to which configurations are prepended
     */
    public function prepend(ContainerBuilder $container): void
    {
        // Iterate over the list of packages that require configuration to be prepended
        foreach (self::PACKAGES_TO_PREPEND as $package) {
            // Load and parse each package-specific YAML config file
            $config = Yaml::parse((string) file_get_contents(__DIR__.'/../Resources/config/packages/'.$package.'.yaml'));

            // Prepend the configuration to the corresponding extension
            foreach ($config as $name => $conf) {
                $container->prependExtensionConfig($name, $conf);
            }
        }
    }

    /**
     * Returns the alias for this extension.
     *
     * The alias is used as the root key in the configuration files.
     *
     * @return string the alias for this extension
     */
    public function getAlias(): string
    {
        return self::ALIAS;
    }
}
