# feature/subscriber

## Description

This feature provides a **HelloWorld banner** that is automatically displayed at the admin pages of your Lodel installation. The banner is injected automatically into the HTML response via an event subscriber, without needing to modify any existing Twig templates.

When an admin page is loaded:
- The subscriber detects the ```/admin``` path
- A yellow banner is appended to the bottom-left of the page
- No manual inclusion or template change is required

The implementation is entirely autonomous — just install the bundle and the banner will appear on all admin pages.

## File sctructure

```bash
HelloWorldBundle/
├── src/
│   ├── EventSubscriber/
│   │   └── HelloWorldSubscriber.php             # Event subscriber that injects the banner into admin pages
│   ├── Resources/
│   │   ├── config/
│   │   │   └── services.yaml                    # Service declaration and subscriber registration
│   │   └── views/
│   │       └── hello_world_banner.html.twig     # Twig template for the banner
```

## Internal Implementation

This feature is composed of the following elements:

- **Event Subscriber** (```HelloWorldSubscriber```): Listens to the ```kernel.response``` event, checks if the current route starts with ```/admin```, and appends the banner HTML to the response content.

- **Twig Template** (```hello_world_banner.html.twig```): Contains the HTML markup and inline CSS to display a fixed yellow banner at the bottom-left corner of the screen.

- **Service Configuration** (```services.yaml```): Declares and tags the event subscriber so Symfony can register it automatically.

## How to use

The banner will be displayed without requiring any change to your existing templates.
