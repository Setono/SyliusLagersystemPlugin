# Sylius Lagersystem Plugin

[![Latest Version][ico-version]][link-packagist]
[![Latest Unstable Version][ico-unstable-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Build Status][ico-github-actions]][link-github-actions]
[![Quality Score][ico-code-quality]][link-code-quality]

This is the official plugin for the [Lagersystem.dk system](https://lagersystem.dk/).

## Installation

### Step 1: Install and enable plugin

Open a command console, enter your project directory and execute the following command to download the latest stable version of this plugin:

```bash
$ composer require setono/sylius-lagersystem-plugin
```

This command requires you to have Composer installed globally, as explained in the [installation chapter](https://getcomposer.org/doc/00-intro.md) of the Composer documentation.

Add bundle to your `config/bundles.php`:

```php
<?php
# config/bundles.php

return [
    // ...
    Setono\SyliusLagersystemPlugin\SetonoSyliusLagersystemPlugin::class => ['all' => true],
    // ...
];

```

### Step 2: Import routing and configs

#### Import routing
 
````yaml
# config/routes/setono_sylius_lagersystem.yaml
setono_sylius_lagersystem:
    resource: "@SetonoSyliusLagersystemPlugin/Resources/config/routes.yaml"
````

#### Import application config

````yaml
# config/packages/setono_sylius_lagersystem.yaml
imports:
    - { resource: "@SetonoSyliusLagersystemPlugin/Resources/config/app/config.yaml" }    
````

### Step 3: Override repositories

Like it was done at:

- [tests/Application/Repository](tests/Application/Repository)
- [tests/Application/config/packages/_sylius.yaml](tests/Application/config/packages/_sylius.yaml)

[ico-version]: https://poser.pugx.org/setono/sylius-lagersystem-plugin/v/stable
[ico-unstable-version]: https://poser.pugx.org/setono/sylius-lagersystem-plugin/v/unstable
[ico-license]: https://poser.pugx.org/setono/sylius-lagersystem-plugin/license
[ico-github-actions]: https://github.com/Setono/SyliusLagersystemPlugin/workflows/build/badge.svg
[ico-code-quality]: https://img.shields.io/scrutinizer/g/Setono/SyliusLagersystemPlugin.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/setono/sylius-lagersystem-plugin
[link-github-actions]: https://github.com/Setono/SyliusLagersystemPlugin/actions
[link-code-quality]: https://scrutinizer-ci.com/g/Setono/SyliusLagersystemPlugin
