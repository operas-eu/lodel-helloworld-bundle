<?php

declare(strict_types=1);

namespace Lodel\HelloWorldBundle\Twig;

use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * This class defines a custom Twig extension for rendering a toggle button
 * that switches between light and dark modes.
 *
 * It extends the AbstractExtension class provided by Twig and adds
 * a new Twig function called 'toggle_mode_button' that can be used in templates.
 */
class ToggleModeButtonExtension extends AbstractExtension
{
    /**
     * Constructor that injects the Twig environment.
     *
     * The Twig environment allows the rendering of templates within this extension.
     *
     * @param Environment $twig the Twig environment used to render templates
     */
    public function __construct(private Environment $twig)
    {
    }

    /**
     * Returns the custom Twig functions provided by this extension.
     *
     * In this case, we register the 'toggle_mode_button' function, which will
     * call the 'toggleModeButton' method in this class to render the button's HTML.
     *
     * @return array<TwigFunction> an array of TwigFunction objects that define the custom functions
     */
    public function getFunctions(): array
    {
        return [
            // Registers the 'toggle_mode_button' function, which calls the 'toggleModeButton' method.
            new TwigFunction('toggle_mode_button', [$this, 'toggleModeButton'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * Renders the HTML for the toggle mode button.
     *
     * This method loads the 'toggle_mode_button.html.twig' template and returns its rendered content.
     * The button is used for toggling between light and dark modes in the application.
     *
     * @return string the rendered HTML content for the toggle button
     */
    public function toggleModeButton(): string
    {
        // Renders the template for the toggle mode button and returns the HTML.
        return $this->twig->render('@HelloWorldBundle/toggle_mode_button.html.twig');
    }
}
