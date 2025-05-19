<?php

declare(strict_types=1);

namespace Lodel\HelloWorldBundle\Form;

use Lodel\Bundle\CoreBundle\Form\UserFormType;
use Lodel\HelloWorldBundle\EventSubscriber\UserFormSubmitSubscriber;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * This class extends the base UserFormType from the core Lodel bundle.
 * It allows injecting additional fields or behavior into the existing form
 * without modifying the original form class.
 *
 * This is especially useful in reusable bundles that want to enhance forms
 * across projects or applications in a decoupled way.
 */
class UserFormTypeExtension extends AbstractTypeExtension
{
    /**
     * Constructor injecting the event subscriber that handles form logic.
     *
     * @param UserFormSubmitSubscriber $subscriber An event listener to handle form submission logic
     */
    public function __construct(private UserFormSubmitSubscriber $subscriber)
    {
    }

    /**
     * Declares the form types that this extension modifies.
     *
     * Symfony will automatically apply this extension to the specified form type(s),
     * in this case UserFormType from the core bundle.
     *
     * @return array The list of form types this extension applies to
     */
    public static function getExtendedTypes(): iterable
    {
        return [UserFormType::class];
    }

    /**
     * Modifies the form by:
     * 1. Adding a new unmapped 'civility' (salutation) field.
     * 2. Attaching an event subscriber to customize submission behavior.
     *
     * @param FormBuilderInterface $builder The form builder instance
     * @param array                $options Options passed to the original form
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Adds a 'civility' radio choice field with predefined values
        $builder->add('civility', ChoiceType::class, [
            'label' => 'Civility', // Display label (translated if using a translation system)
            'choices' => [
                'Mr.' => 'Mr.',
                'Mrs.' => 'Mrs.',
                'Miss' => 'Miss',
            ],
            'expanded' => true,     // Display as radio buttons
            'required' => false,    // Not required to submit the form
            'mapped' => false,      // Not bound to the User entity (used only for display/input)
        ]);

        // Attach the subscriber to listen for PRE_SUBMIT events and alter form data
        $builder->addEventSubscriber($this->subscriber);
    }
}
