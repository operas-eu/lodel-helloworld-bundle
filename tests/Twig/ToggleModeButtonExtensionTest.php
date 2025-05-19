<?php

declare(strict_types=1);

namespace Lodel\HelloWorldBundle\Tests\Twig;

use Lodel\HelloWorldBundle\Twig\ToggleModeButtonExtension;
use PHPUnit\Framework\TestCase;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

/**
 * Test class for the ToggleModeButtonExtension.
 *
 * This class tests the functionality of the ToggleModeButtonExtension class,
 * specifically the registration of the 'toggle_mode_button' Twig function
 * and its correct rendering of the mode toggle button.
 */
class ToggleModeButtonExtensionTest extends TestCase
{
    /** @var ToggleModeButtonExtension The custom Twig extension being tested */
    private ToggleModeButtonExtension $extension;

    /**
     * Set up the test environment: initialize the Twig environment and the custom extension.
     */
    protected function setUp(): void
    {
        // Create a FilesystemLoader that loads templates from the HelloWorldBundle's view directory
        $loader = new FilesystemLoader();
        $loader->addPath(__DIR__.'/../../src/Resources/views', 'HelloWorldBundle');

        // Initialize the Twig environment with the created loader
        $twig = new Environment($loader);

        // Instantiate the custom extension with the initialized Twig environment
        $this->extension = new ToggleModeButtonExtension($twig);
    }

    /**
     * Test to ensure that the extension registers the correct functions.
     */
    public function testGetFunctions(): void
    {
        // Get all functions registered by the extension
        $functions = $this->extension->getFunctions();

        // Ensure that all registered functions are instances of TwigFunction
        $this->assertContainsOnlyInstancesOf(TwigFunction::class, $functions);

        // Extract the names of the registered functions
        $functionNames = array_map(
            function (TwigFunction $function) {
                return $function->getName();
            },
            $functions
        );

        // Assert that exactly one function is registered
        $this->assertCount(1, $functionNames);

        // Check that the function name 'toggle_mode_button' is registered
        $this->assertContains('toggle_mode_button', $functionNames);
    }

    /**
     * Test the output of the toggleModeButton() function from the extension.
     */
    public function testToggleModeButton(): void
    {
        // Call the toggleModeButton() function to get the output
        $result = $this->extension->toggleModeButton();

        // Verify that the returned output contains the expected HTML button
        $this->assertStringContainsString('<button id="toggle-mode-button">', $result);
    }
}
