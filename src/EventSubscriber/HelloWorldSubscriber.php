<?php

declare(strict_types=1);

namespace Lodel\HelloWorldBundle\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

/**
 * Event subscriber that listens to all kernel request events.
 *
 * It injects a custom HTML banner into the admin pages based on the current route.
 * This class implements Symfony's EventSubscriberInterface, which allows it to
 * subscribe to one or multiple events and handle them automatically.
 */
class HelloWorldSubscriber implements EventSubscriberInterface
{
    /**
     * Constructor method that takes the Twig and Router services as arguments.
     *
     * @param Environment     $twig   The Twig service to render the templates
     * @param RouterInterface $router The Router service to access current route information
     */
    public function __construct(private Environment $twig, private RouterInterface $router)
    {
    }

    /**
     * This method is triggered by the kernel.response event.
     * It allows manipulating the HTTP response before it's sent to the client.
     *
     * @param ResponseEvent $event The event containing the HTTP response
     */
    public function onKernelResponse(ResponseEvent $event): void
    {
        // Retrieve the current route path
        $currentPath = $this->router->getContext()->getPathInfo();

        // Check if the current path starts with '/admin'
        if (str_starts_with($currentPath, '/admin')) {
            // Get the Response object from the event
            $response = $event->getResponse();

            // Render the banner's HTML content using Twig
            $bannerHtml = $this->twig->render('@HelloWorldBundle/hello_world_banner.html.twig');

            // Get the current content of the response
            $content = $response->getContent();

            // Append the banner HTML to the existing response content
            $content .= $bannerHtml;

            // Set the updated content back into the response
            $response->setContent($content);
        }
    }

    /**
     * This method returns the events that this class subscribes to.
     * It defines the kernel.response event, which is triggered when a response is ready.
     *
     * @return array<string, string> The mapping of the event kernel.response to the onKernelResponse method
     */
    public static function getSubscribedEvents(): array
    {
        // Subscribe to the kernel.response event and map it to the onKernelResponse method
        return [
            KernelEvents::RESPONSE => 'onKernelResponse',
        ];
    }
}
