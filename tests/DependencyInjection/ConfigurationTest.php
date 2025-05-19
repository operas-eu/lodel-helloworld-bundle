<?php

declare(strict_types=1);

namespace Lodel\HelloWorldBundle\Tests\DependencyInjection;

use Lodel\HelloWorldBundle\DependencyInjection\Configuration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
 * Class ConfigurationTest.
 *
 * This test ensures that the Configuration class correctly builds and defines the
 * configuration tree, particularly the root node name. The test verifies that
 * the root node is properly set to 'lodel_hello_world' in the configuration tree.
 */
class ConfigurationTest extends TestCase
{
    /**
     * Tests the configuration tree builder to ensure that the root node is set correctly.
     *
     * This test validates the structure of the configuration tree by checking that:
     * - The TreeBuilder object is returned by the getConfigTreeBuilder method.
     * - The root node of the configuration is correctly named 'lodel_hello_world'.
     */
    public function testGetConfigTreeBuilder(): void
    {
        // Initialize the Configuration class
        $configuration = new Configuration();

        // Get the configuration tree builder
        $treeBuilder = $configuration->getConfigTreeBuilder();

        // Assert that the tree builder is of type TreeBuilder
        $this->assertInstanceOf(TreeBuilder::class, $treeBuilder);

        // Get the root node of the configuration tree
        $rootNode = $treeBuilder->getRootNode();

        // Ensure that the root node is not null
        $this->assertNotNull($rootNode);

        // Use reflection to access the protected 'name' property of the root node
        $class = new \ReflectionClass($rootNode);
        $name = $class->getProperty('name');
        $name->setAccessible(true);

        // Assert that the root node's name is 'lodel_hello_world'
        $this->assertSame('lodel_hello_world', $name->getValue($rootNode));
    }
}
