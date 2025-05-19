# Installation Guide

Before installing this bundle, ensure your environment meets the following requirements:

- **PHP**: Version 8.1 or higher (configurable if needed)
- **Symfony**: Version 6.4 (configurable if needed)

From the root directory of your Lodel 2.0 application, declare the repository source:

<<<<<<< HEAD
    $ composer config repositories.lodel/lodel-helloworld-bundle vcs git@gitlab.huma-num.fr:openedition/lodel/lodel-helloworld-bundle.git

Then add the dependency:

    $ composer require lodel/lodel-helloworld-bundle:dev-main
=======
    $ composer config repositories.lodel/lodel-hello-world-bundle vcs git@gitlab.huma-num.fr:openedition/lodel/lodel-hello-world-bundle.git

Then add the dependency:

    $ composer require lodel/lodel-hello-world-bundle:dev-main
>>>>>>> 7020c5d (First base branch)

Normally, the bundle will be automatically enabled and ready to use without requiring any additional configuration. However, if manual enabling is necessary, verify the bundle is registered as follows:

    // config/bundles.php

    return [
        // ...
        Lodel\HelloWorldBundle\HelloWorldBundle::class => ['all' => true],
    ];
