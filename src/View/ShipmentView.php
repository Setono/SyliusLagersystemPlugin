<?php

declare(strict_types=1);

namespace Sylius\ShopApiPlugin\View\Checkout;

namespace Setono\SyliusLagersystemPlugin\View;

class ShipmentView
{
    /** @var string|null */
    public $state;

    /** @var ShippingMethodView|null */
    public $method;
}
