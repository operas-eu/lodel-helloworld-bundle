# feature/button

## Description

This feature provides a **toggle button** that lets users switch between **dark** and **light** modes dynamically. The button can be added anywhere in your Twig templates using the custom function.

When clicked, the button:
- Applies the corresponding **dark** or **light** class to the <body>
- Updates its label to reflect the current mode
- Saves the user’s choice in a browser cookie so it persists across sessions

The implementation is fully autonomous — no need to write additional HTML, JavaScript, or CSS in your templates.

## File sctructure

```bash
HelloWorldBundle/
├── src/
│   ├── Resources/
│   │   ├── config/
│   │   │   └── services.yaml                    # Service declaration for the Twig extension
│   │   └── views/
│   │       └── toggle_mode_button.html.twig     # Twig template for the toggle button
│   └── Twig/
│       └── ToggleModeButtonExtension.php        # Twig extension class exposing the function
```

## Internal Implementation

This feature is composed of the following elements:

- **Twig Extension** (```ToggleModeButtonExtension```): Registers a Twig function named toggle_mode_button, and renders the corresponding Twig partial.

- **Twig Template** (```toggle_mode_button.html.twig```): Contains the HTML markup for the button, the CSS styles for both modes and JavaScript that toggles the mode and stores the preference in a cookie.

- **Service Configuration** (```services.yaml```): Declares the Twig extension as a service and tags it appropriately so Symfony can register it.

## How to use

To integrate the toggle button into your platform:

- Open the Twig template where you want the button to appear (for example, your main layout ```base.html.twig``` to make it available on all pages)

- Insert the following line where you want the button to appear:

```bash
{{ toggle_mode_button() }}
```
