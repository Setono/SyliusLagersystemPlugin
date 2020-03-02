<?php

declare(strict_types=1);

namespace Tests\Setono\SyliusLagersystemPlugin\Controller\Order;

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

    protected function getOrdersIndexUrl(): string
    {
        return '/api/lagersystem/orders';
    }
}
