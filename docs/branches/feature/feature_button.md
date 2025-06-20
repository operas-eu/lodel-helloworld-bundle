# feature/button

## Description

This feature provides a simple Dark/Light mode toggle button for the application.

It is implemented through a Twig function ```{{ toggle_mode_button() }}```, which automatically injects the required HTML, CSS, and JavaScript into the page.

When the user clicks the button, the theme switches dynamically between light and dark modes, and the choice is saved in a cookie to persist across sessions. The button text updates according to the current mode.

## How to use

To integrate the toggle button into your platform:

- Open the Twig template where you want the button to appear (for example, your main layout ```base.html.twig``` to make it available on all pages)

- Insert the following line where you want the button to appear:
    
    {{ toggle_mode_button() }}
