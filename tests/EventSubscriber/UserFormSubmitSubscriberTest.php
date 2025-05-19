<?php

declare(strict_types=1);

namespace Lodel\HelloWorldBundle\Tests\EventSubscriber;

use Lodel\HelloWorldBundle\EventSubscriber\UserFormSubmitSubscriber;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

/**
 * This test class verifies the behavior of UserFormSubmitSubscriber.
 * It ensures the subscriber listens to the correct event and modifies form data as expected.
 *
 * @group lodel
 */
class UserFormSubmitSubscriberTest extends TestCase
{
    /** @var FormInterface&MockObject Mocked form interface */
    private FormInterface&MockObject $form;

    /** @var UserFormSubmitSubscriber The event subscriber under test */
    private UserFormSubmitSubscriber $subscriber;

    /**
     * Initializes the mocked FormInterface and the real subscriber instance.
     * Called before each test.
     */
    protected function setUp(): void
    {
        // Create a mock form interface to be passed to FormEvent
        $this->form = $this->createMock(FormInterface::class);

        // Instantiate the actual subscriber
        $this->subscriber = new UserFormSubmitSubscriber();
    }

    /**
     * Tests that the subscriber correctly registers to the FormEvents::PRE_SUBMIT event.
     */
    public function testGetSubscribedEvents(): void
    {
        $events = UserFormSubmitSubscriber::getSubscribedEvents();

        // Ensure PRE_SUBMIT is present and mapped to 'onPreSubmit'
        $this->assertArrayHasKey(FormEvents::PRE_SUBMIT, $events);
        $this->assertEquals('onPreSubmit', $events[FormEvents::PRE_SUBMIT]);
    }

    /**
     * Tests the behavior of the onPreSubmit() method using different sets of submitted data.
     * Uses a data provider to cover multiple scenarios.
     *
     * @dataProvider provideFormData
     */
    public function testCivilityIsPrependedToLastName(array $submittedData, array $expectedData): void
    {
        // Simulate a form event with submitted data
        $event = new FormEvent($this->form, $submittedData);

        // Trigger the subscriber logic
        $this->subscriber->onPreSubmit($event);

        // Assert the data has been updated accordingly
        $this->assertEquals($expectedData, $event->getData());
    }

    /**
     * Provides different test cases for form submissions:
     * - No civility provided: lastName should remain unchanged
     * - Civility provided: civility is prepended to lastName
     * - Empty civility: should be treated as missing, lastName unchanged
     */
    public static function provideFormData(): array
    {
        return [
            'No civility' => [
                ['lastName' => 'Doe'],
                ['lastName' => 'Doe'],
            ],
            'With civility' => [
                ['lastName' => 'Doe', 'civility' => 'Mr.'],
                ['lastName' => 'Mr. Doe', 'civility' => 'Mr.'],
            ],
            'Empty civility' => [
                ['lastName' => 'Doe', 'civility' => ''],
                ['lastName' => 'Doe', 'civility' => ''],
            ],
        ];
    }
}
