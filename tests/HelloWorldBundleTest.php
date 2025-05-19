<?php

declare(strict_types=1);

namespace Lodel\HelloWorldBundle\Tests;

use Lodel\HelloWorldBundle\DependencyInjection\HelloWorldExtension;
use Lodel\HelloWorldBundle\HelloWorldBundle;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class HelloWorldBundleTest.
 *
 * This class is a test case for the HelloWorldBundle. It extends KernelTestCase,
 * which allows it to interact with the Symfony Kernel and the service container
 * to test the integration of the bundle within the Symfony framework.
 *
 * The purpose of this test is to verify that the HelloWorldBundle is correctly
 * configuring its services and extensions within the Symfony application.
 */
class HelloWorldBundleTest extends KernelTestCase
{
    /**
     * Test that the container extension of HelloWorldBundle is properly set.
     *
     * This test ensures that when an instance of HelloWorldBundle is created,
     * it returns the correct container extension (HelloWorldExtension).
     * The container extension is responsible for managing the configuration
     * and services of the bundle within the Symfony service container.
     */
    public function testGetContainerExtension(): void
    {
        // Create an instance of the HelloWorldBundle
        $bundle = new HelloWorldBundle();

        // Verify that the extension returned by the bundle is an instance of HelloWorldExtension
        // The getContainerExtension() method should return an object of the class HelloWorldExtension.
        $this->assertInstanceOf(HelloWorldExtension::class, $bundle->getContainerExtension());
    }
}
