<?php

declare(strict_types=1);

namespace Lodel\HelloWorldBundle\Tests\EventSubscriber;

use Lodel\HelloWorldBundle\EventSubscriber\HelloWorldSubscriber;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * This class contains tests for the HelloWorldSubscriber class.
 * It ensures that the HelloWorldSubscriber behaves as expected
 * by simulating the kernel response event and verifying
 * the correct behavior of the subscriber, particularly in terms
 * of rendering the HTML banner in the response.
 */
class HelloWorldSubscriberTest extends TestCase
{
    /** @var HelloWorldSubscriber The subscriber being tested */
    private HelloWorldSubscriber $helloWorldSubscriber;

    /**
     * Sets up the testing environment.
     * Initializes necessary dependencies like Twig, Router, and the HelloWorldSubscriber instance.
     * It also mocks the router to return a specific path for testing purposes.
     */
    protected function setUp(): void
    {
        // Create a real Twig environment
        $loader = new FilesystemLoader();
        $loader->addPath(__DIR__.'/../../src/Resources/views', 'HelloWorldBundle');
        $twig = new Environment($loader);

        // Set up the request context with a path
        $context = new RequestContext();
        $context->setPathInfo('/admin/dashboard');

        // Mock the RouterInterface to simulate the route context
        /** @var RouterInterface&MockObject $router */
        $router = $this->createMock(RouterInterface::class);
        $router->method('getContext')->willReturn($context);

        // Instantiate the subscriber with the mocked dependencies
        $this->helloWorldSubscriber = new HelloWorldSubscriber($twig, $router);
    }

    /**
     * Test that the subscriber correctly modifies the response
     * by adding a banner when the onKernelResponse event is triggered.
     */
    public function testOnKernelResponse(): void
    {
        // Mock the HttpKernelInterface (the kernel isn't really used in this test)
        /** @var HttpKernelInterface&MockObject $kernel */
        $kernel = $this->createMock(HttpKernelInterface::class);

        // Create a request with the path '/admin/dashboard'
        $request = Request::create('/admin/dashboard');

        // Create a new Response object
        $response = new Response();

        // Create a ResponseEvent with the request and response
        $event = new ResponseEvent(
            $kernel,
            $request,
            HttpKernelInterface::MAIN_REQUEST,
            $response
        );

        // Trigger the subscriber's event handler
        $this->helloWorldSubscriber->onKernelResponse($event);

        // Assert that the banner content is correctly added to the response
        $this->assertStringContainsString('This page is enhanced by HelloWorldBundle', (string) $response->getContent());
    }

    /**
     * Test that the HelloWorldSubscriber subscribes to the correct event.
     * It checks that the subscriber listens to the KernelEvents::RESPONSE event
     * and triggers the onKernelResponse method.
     */
    public function testGetSubscribedEvents(): void
    {
        // Get the events the subscriber is subscribed to
        $events = HelloWorldSubscriber::getSubscribedEvents();

        // Assert that the subscriber listens to KernelEvents::RESPONSE and maps it to onKernelResponse
        $this->assertArrayHasKey(KernelEvents::RESPONSE, $events);
        $this->assertSame('onKernelResponse', $events[KernelEvents::RESPONSE]);
    }
}
