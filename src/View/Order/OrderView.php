<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\View\Order;

use Setono\SyliusLagersystemPlugin\View\AddressView;
use Setono\SyliusLagersystemPlugin\View\Customer\CustomerView;
use Setono\SyliusLagersystemPlugin\View\PaymentView;
use Setono\SyliusLagersystemPlugin\View\ShipmentView;

class OrderView
{
    /** @var int|null */
    public $id;

    /** @var string|null */
    public $number;

    /** @var string|null */
    public $channel;

    /** @var string|null */
    public $currencyCode;

    /** @var string|null */
    public $localeCode;

    /** @var string|null */
    public $state;

    /** @var string|null */
    public $checkoutState;

    /** @var string|null */
    public $checkoutCompletedAt;

    /** @var string|null */
    public $paymentState;

    /** @var array|PaymentView[] */
    public $payments = [];

    /** @var string|null */
    public $shippingState;

    /** @var array|ShipmentView[] */
    public $shipments = [];

    /** @var AddressView */
    public $shippingAddress;

    /** @var AddressView */
    public $billingAddress;

    /** @var int|null */
    public $total;

    /** @var CustomerView|null */
    public $customer;
}
