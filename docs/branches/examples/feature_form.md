# feature/form

## Description

This feature extends the default UserFormType used in Lodel to introduce a new ```civility``` field and customize form submission behavior — without altering the original form class or template.

It adds:

- A new unmapped radio field called civility with choices: ```Mr.```, ```Mrs.```, ```Miss``` or ```none```
- An event subscriber that listens to the ```PRE_SUBMIT``` phase and prepends the selected ```civility``` to the user’s last name

The extension is seamlessly integrated into the existing form and does not require any manual template updates or controller changes.

## File structure

```bash
HelloWorldBundle/
├── src/
│   ├── EventSubscriber/
│   │   └── UserFormSubmitSubscriber.php         # Modifies form data during the PRE_SUBMIT event
│   └── Form/
│       └── UserFormTypeExtension.php            # Extends the original UserFormType to add the "civility" field
│   └── Resources/
│       └── config/
│           └── services.yaml                    # Declares and tags the form extension and subscriber
```

## Internal Implementation

This feature is composed of the following elements:

- **Form Type Extension** (```UserFormTypeExtension```): Adds a ```civility``` radio field (unmapped) to the form and attaches the custom event subscriber.

- **Event Subscriber** (```UserFormSubmitSubscriber```): Listens to ```FormEvents::PRE_SUBMIT``` and prepends the selected ```civility``` to the submitted lastName field.

- **Service Configuration** (```services.yaml```): Registers the form type extension and event subscriber with the appropriate tags for Symfony to recognize and apply them automatically.

## How to use

You will see the additional ```"Civility"``` field appear, and it will automatically influence the submitted lastName without any modification to the original form or template.
