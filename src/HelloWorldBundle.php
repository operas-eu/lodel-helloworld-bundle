<?php

declare(strict_types=1);

namespace Lodel\HelloWorldBundle;

use Lodel\HelloWorldBundle\DependencyInjection\HelloWorldExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class HelloWorldBundle.
 *
 * This is the main bundle class for the HelloWorldBundle.
 * It extends the Symfony Bundle class to integrate with the Symfony application.
 *
 * By registering this bundle in the application, it allows Symfony to load and execute
 * its services, configuration, and other components defined within this bundle.
 */
class HelloWorldBundle extends Bundle
{
    /**
     * Overrides the base method to provide a custom extension instance.
     *
     * This ensures that the bundle uses the HelloWorldExtension class
     * to process its configuration and load services into the container.
     */
    public function getContainerExtension(): ?ExtensionInterface
    {
        if (null === $this->extension) {
            $this->extension = new HelloWorldExtension();
        }

        return $this->extension;
    }
}
