<?php

declare(strict_types=1);

namespace Lodel\HelloWorldBundle\Tests;

use Lodel\HelloWorldBundle\HelloWorldBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Custom kernel class for testing purposes.
 *
 * This class is a minimal implementation of the Symfony Kernel used specifically
 * for running tests. It registers the necessary bundles and allows the container
 * to be configured for the test environment.
 */
class TestKernel extends Kernel
{
    /**
     * Registers the bundles required for the test environment.
     *
     * In this case, we register the core Symfony FrameworkBundle and our custom
     * HelloWorldBundle. These bundles will be available when the kernel is booted
     * during testing.
     *
     * @return BundleInterface[] the list of bundles to register for the test kernel
     */
    public function registerBundles(): iterable
    {
        // Register the HelloWorldBundle to test our custom bundle's behavior
        yield new HelloWorldBundle();

        // Register the Symfony FrameworkBundle to include basic Symfony services
        yield new FrameworkBundle();

        // Register the TwigBundle to enable Twig template rendering
        yield new TwigBundle();
    }

    /**
     * Configures the container with necessary services or configurations.
     *
     * This method is typically used to load configuration files or service definitions
     * specific to the test environment. In this case, it's intentionally left empty
     * as no additional configuration is needed for this test kernel.
     *
     * @param LoaderInterface $loader the loader to use for configuration
     */
    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        // Load configuration for the 'framework' bundle and the router
        $loader->load(function (ContainerBuilder $container) {
            $container->loadFromExtension(
                'framework', [
                    'test' => true,
                    'router' => [
                        'resource' => __DIR__.'/../src/Controller',
                    ],
                ],
            );
            $container->loadFromExtension(
                'twig', [
                    'paths' => [
                        __DIR__.'/../src/Resources/views' => 'HelloWorldBundle',
                    ],
                ],
            );
            $container->setParameter('kernel.secret', 'foo');
        });
    }
}
