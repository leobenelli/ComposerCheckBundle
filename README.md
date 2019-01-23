ComposerCheckBundle
==========================

Symfony Bundle to check Version alignment (via Composer) with the latest Bundle versions.

It's in development, it will be ready soon.

Installation
============

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require leobenelli/composer-check-bundle
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
<?php

return [
    ...
    LeoBenelli\LBComposerCheckBundle\LBComposerCheckBundle::class => ['all' => true],
    ...
];

```

Step 3: Activate routing 
-------------------------
Add new file **"lb_composer_check.yaml"** in config folder 
```
lb_composer_check:
    resource: '@LBComposerCheckBundle/Controller/'
    type: annotation
```


After that, you can show the Composer Bundles Version by the link http://<hostname>/lb_composer_check_bundle/show_pkgs 
(example: http://localhost:8000/lb_composer_check_bundle/show_pkgs)

Step 4: Add page link
-------------------------
Enabling the route on step 3, you can add the link of page in your application by the action name **leobenelli_lbcomposercheck_default_showpackages**
Example:
```
<a href="{{path("leobenelli_lbcomposercheck_default_showpackages")}}" > Composer Check Bundles Version</a>
```
