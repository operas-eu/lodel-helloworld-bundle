# Installation Guide

Before installing this bundle, ensure your environment meets the following requirements:

- **PHP**: Version 8.1 or higher (configurable if needed)
- **Symfony**: Version 6.4 (configurable if needed)

From the root directory of your Lodel 2.0 application, declare the repository source:

```bash
$ composer config repositories.lodel/lodel-helloworld-bundle vcs git@github.com:operas-eu/lodel-helloworld-bundle.git
```

Then add the dependency:

```bash
$ composer require lodel/lodel-helloworld-bundle:dev-main
```

Normally, the bundle will be automatically enabled and ready to use without requiring any additional configuration. However, if manual enabling is necessary, verify the bundle is registered as follows:

```php
// config/bundles.php

return [
    // ...
    Lodel\HelloWorldBundle\HelloWorldBundle::class => ['all' => true],
];
```
