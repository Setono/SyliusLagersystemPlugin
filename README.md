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

## Notes

- We assume that product variant's shipping weight stored in kilos at database.
- Lagersystem API returns its weight in grams
- Not tracked product variant's onHand property is always have 1 at Lagersystem API response

## Requests examples

### Prerequisites

- Install Curl CLI and JQ:

    ```bash
    # OSX
    brew install curl
    brew install jq
    ```
- Load default Sylius fixtures suite:

    ```bash
    (cd tests/Application && bin/console sylius:fixtures:load default -n)
    ```

- Run local server:

    ```bash
    (cd tests/Application && symfony server:start --port=8000)
    ```

### Auth

```bash
SYLIUS_HOST=http://localhost:8000
SYLIUS_ADMIN_API_ACCESS_TOKEN=$(curl $SYLIUS_HOST/api/oauth/v2/token \
    --show-error \
    -d "client_id"=demo_client \
    -d "client_secret"=secret_demo_client \
    -d "grant_type"=password \
    -d "username"=api@example.com \
    -d "password"=sylius-api | jq '.access_token' --raw-output)
echo $SYLIUS_ADMIN_API_ACCESS_TOKEN
```

### Product variant list endpoint

```bash
curl "$SYLIUS_HOST/api/lagersystem/product-variants?locale=en_US&limit=3" \
    -H "Authorization: Bearer $SYLIUS_ADMIN_API_ACCESS_TOKEN"
```

### Product variant show endpoint

```bash
SYLIUS_SOME_PRODUCT_VARIANT_CODE=$(curl "$SYLIUS_HOST/api/lagersystem/product-variants?locale=en_US&limit=1" \
    --show-error \
    -H "Authorization: Bearer $SYLIUS_ADMIN_API_ACCESS_TOKEN" \
    -H "Accept: application/json" | jq '.items[0].code' --raw-output)
echo "Some product code: $SYLIUS_SOME_PRODUCT_VARIANT_CODE"

curl "$SYLIUS_HOST/api/lagersystem/product-variants/$SYLIUS_SOME_PRODUCT_VARIANT_CODE?locale=en_US" \
    -H "Authorization: Bearer $SYLIUS_ADMIN_API_ACCESS_TOKEN"
```

### Order list enpoint

```bash
curl "$SYLIUS_HOST/api/lagersystem/orders?limit=3" \
    -H "Authorization: Bearer $SYLIUS_ADMIN_API_ACCESS_TOKEN"
```

[ico-version]: https://poser.pugx.org/setono/sylius-lagersystem-plugin/v/stable
[ico-unstable-version]: https://poser.pugx.org/setono/sylius-lagersystem-plugin/v/unstable
[ico-license]: https://poser.pugx.org/setono/sylius-lagersystem-plugin/license
[ico-github-actions]: https://github.com/Setono/SyliusLagersystemPlugin/workflows/build/badge.svg
[ico-code-quality]: https://img.shields.io/scrutinizer/g/Setono/SyliusLagersystemPlugin.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/setono/sylius-lagersystem-plugin
[link-github-actions]: https://github.com/Setono/SyliusLagersystemPlugin/actions
[link-code-quality]: https://scrutinizer-ci.com/g/Setono/SyliusLagersystemPlugin
