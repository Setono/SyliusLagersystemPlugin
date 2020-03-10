<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\View\Shipping;

use Setono\SyliusLagersystemPlugin\View\Order\OrderView;

class ShipmentView
{
    /** @var int|null */
    public $id;

    /** @var string|null */
    public $state;

    /** @var ShippingMethodView|null */
    public $method;

    /** @var OrderView|null */
    public $order;

    /** @var array|ShipmentUnitView[] */
    public $units;

    /** @var string|null */
    public $tracking;

    /** @var string|null */
    public $shippedAt;
}
