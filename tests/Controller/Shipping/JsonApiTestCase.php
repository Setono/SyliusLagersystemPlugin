<?php

declare(strict_types=1);

namespace Tests\Setono\SyliusLagersystemPlugin\Controller\Shipping;

use function Safe\sprintf;
use Tests\Setono\SyliusLagersystemPlugin\Controller\JsonApiTestCase as BaseJsonApiTestCase;

abstract class JsonApiTestCase extends BaseJsonApiTestCase
{
    protected $defaultFixtureFiles = [
        'api_administrator.yml',
        'shop.yml',
        'payment.yml',
        'shipping.yml',
        'customer.yml',
        'address.yml',
        'product.yml',
        'order.yml',
    ];

    protected function getShipmentsIndexUrl(?string $localeCode = null): string
    {
        if (null !== $localeCode) {
            return sprintf(
                '/api/lagersystem/shipments?locale=%s',
                $localeCode
            );
        }

        return '/api/lagersystem/shipments';
    }
}
