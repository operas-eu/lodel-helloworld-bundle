<?php

declare(strict_types=1);

namespace Lodel\HelloWorldBundle\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

/**
 * This class listens to Symfony form events and modifies form data
 * before it is submitted (but after it is bound to the request).
 *
 * Specifically, it prepends the "civility" value to the "lastName" field
 * if "civility" has been filled in by the user.
 */
class UserFormSubmitSubscriber implements EventSubscriberInterface
{
    /**
     * This method registers the form event(s) that this subscriber listens to.
     *
     * In this case, we are listening to the PRE_SUBMIT event, which occurs
     * after the form is submitted but before data is bound to the form object.
     *
     * @return array the event name(s) mapped to the corresponding handler method(s)
     */
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SUBMIT => 'onPreSubmit',
        ];
    }

    /**
     * This method is triggered during the PRE_SUBMIT phase of the form submission process.
     * It allows us to modify the raw data submitted by the user before it is processed further.
     *
     * @param FormEvent $event the form event that provides access to the submitted data
     */
    public function onPreSubmit(FormEvent $event): void
    {
        // Retrieve the submitted form data as an associative array
        $data = $event->getData();

        // If the user selected a civility (e.g., 'Mr.', 'Mrs.'), prepend it to the last name
        if (isset($data['civility']) && !empty($data['civility'])) {
            $data['lastName'] = $data['civility'].' '.$data['lastName'];
        }

        // Set the updated data back into the form
        $event->setData($data);
    }
}
