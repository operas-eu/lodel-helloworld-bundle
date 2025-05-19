<?php

declare(strict_types=1);

namespace Lodel\HelloWorldBundle\Tests\DependencyInjection;

use Lodel\HelloWorldBundle\DependencyInjection\HelloWorldExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Test class for HelloWorldExtension.
 *
 * This class tests the functionality of the HelloWorldExtension class in the context of Symfony's Dependency Injection.
 */
class HelloWorldExtensionTest extends TestCase
{
    private HelloWorldExtension $extension;
    private ContainerBuilder $container;

    /**
     * Set up the test environment by initializing the HelloWorldExtension and ContainerBuilder instances.
     * This method runs before each test to ensure the environment is prepared.
     */
    protected function setUp(): void
    {
        $this->extension = new HelloWorldExtension(); // Initialize the extension
        $this->container = new ContainerBuilder(); // Initialize the container builder
    }

    /**
     * Tests that the services.yaml file is loaded
     * and that the 'lodel_hello_world' parameter is set.
     */
    public function testLoad(): void
    {
        // Simulate the configuration input
        $configs = [];

        // Call the load method
        $this->extension->load($configs, $this->container);

        // Assert that services.yaml is loaded by checking for a known service
        $this->assertTrue($this->container->hasParameter('lodel_hello_world'));
        $this->assertIsArray($this->container->getParameter('lodel_hello_world'));

        // Assert that the configuration parameter matches the input
        $expectedConfig = ['hello' => 'world'];
        $this->assertSame($expectedConfig, $this->container->getParameter('lodel_hello_world'));
    }

    /**
     * Tests that the configuration is properly prepended to other bundles.
     */
    public function testPrepend(): void
    {
        // Assert that no configuration is loaded for 'lodel_hello_world' before calling prepend
        $this->assertEmpty($this->container->getExtensionConfig('lodel_hello_world'));

        // Assert that no 'translator' configuration exists within 'framework' before calling prepend
        $frameworkConfig = $this->container->getExtensionConfig('framework');
        $translatorConfig = array_filter($frameworkConfig, fn ($config) => isset($config['translator']));
        $this->assertEmpty($translatorConfig);

        // Assert that no configuration for 'twig' exists before calling prepend
        $twigConfig = $this->container->getExtensionConfig('twig');
        $this->assertEmpty($twigConfig);

        // Call the prepend method, which should add or merge the configuration for the extensions
        $this->extension->prepend($this->container);

        // Assert that configuration for 'lodel_hello_world' has been added after calling prepend
        $lodelConfig = $this->container->getExtensionConfig('lodel_hello_world');
        $this->assertNotEmpty($lodelConfig);

        // Assert that 'translator' configuration exists and is not empty within 'framework' after calling prepend
        $frameworkConfig = $this->container->getExtensionConfig('framework');
        $translatorConfig = array_filter($frameworkConfig, fn ($config) => isset($config['translator']));
        $this->assertNotEmpty($translatorConfig);

        // Assert that the 'twig' package configuration exists and is not empty
        $twigConfig = $this->container->getExtensionConfig('twig');
        $this->assertNotEmpty($twigConfig);
    }

    /**
     * Test that the correct alias is returned by the extension.
     * This verifies that the getAlias() method returns the expected alias 'lodel_hello_world'.
     */
    public function testGetAlias(): void
    {
        $this->assertSame('lodel_hello_world', $this->extension->getAlias()); // Assert that the alias matches the expected value
    }
}
