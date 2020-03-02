<?php

declare(strict_types=1);

namespace Sylius\ShopApiPlugin\View\Cart;

namespace Setono\SyliusLagersystemPlugin\View;

class PaymentView
{
    /** @var string */
    public $state;

    /** @var PaymentMethodView|null */
    public $method;
}
