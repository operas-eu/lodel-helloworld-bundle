<?php

declare(strict_types=1);

namespace Lodel\HelloWorldBundle\Tests\Form;

use Lodel\Bundle\CoreBundle\Form\UserFormType;
use Lodel\HelloWorldBundle\EventSubscriber\UserFormSubmitSubscriber;
use Lodel\HelloWorldBundle\Form\UserFormTypeExtension;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * This test class validates the behavior of UserFormTypeExtension.
 * It ensures the form extension adds a 'civility' field and the event subscriber as expected.
 *
 * @group lodel
 */
class UserFormTypeExtensionTest extends TestCase
{
    /** @var FormBuilderInterface&MockObject Mocked form builder interface */
    private FormBuilderInterface&MockObject $builder;

    /** @var UserFormSubmitSubscriber The event subscriber to test */
    private UserFormSubmitSubscriber $subscriber;

    /** @var UserFormTypeExtension The form type extension under test */
    private UserFormTypeExtension $extension;

    /**
     * Set up the test case with a mock builder, real subscriber, and extension.
     * This setup ensures that we only test the form logic, not Symfony internals.
     */
    protected function setUp(): void
    {
        // Create a mock for the form builder
        $this->builder = $this->createMock(FormBuilderInterface::class);

        // Instantiate the real event subscriber
        $this->subscriber = new UserFormSubmitSubscriber();

        // Create the form type extension with the subscriber injected
        $this->extension = new UserFormTypeExtension($this->subscriber);
    }

    /**
     * This test verifies that:
     * - The 'civility' field is added with the correct type and configuration
     * - The event subscriber is attached to the form
     */
    public function testBuildFormAddsCivilityFieldAndSubscriber(): void
    {
        // Expect the builder to call 'add' once to register the 'civility' field
        $this->builder
            ->expects($this->once())
            ->method('add')
            ->with(
                'civility',                      // Field name
                ChoiceType::class,              // Field type
                $this->callback(function ($options) {
                    // Validate the field options
                    return isset($options['choices']['Mr.'])      // Must have 'Mr.' in choices
                        && false === $options['mapped']           // Should not be mapped to the entity
                        && true === $options['expanded'];         // Should be rendered as radio buttons
                })
            )
            ->willReturnSelf(); // Allow method chaining (e.g., builder->add(...)->addEventSubscriber(...))

        // Expect the builder to add the event subscriber
        $this->builder
            ->expects($this->once())
            ->method('addEventSubscriber')
            ->with($this->subscriber)
            ->willReturnSelf();

        // Call the method under test
        $this->extension->buildForm($this->builder, []);
    }

    /**
     * This test ensures that getExtendedTypes() returns the expected form type (UserFormType).
     */
    public function testGetExtendedTypes(): void
    {
        $this->assertEquals(
            [UserFormType::class],             // Expected output
            $this->extension::getExtendedTypes() // Actual method call
        );
    }
}
