<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\View\Shipping;

use Setono\SyliusLagersystemPlugin\View\Product\ProductVariantView;

class ShipmentUnitView
{
    /** @var ProductVariantView|null */
    public $shippable;

    /** @var int|null */
    public $total;

    /** @var int|null */
    public $adjustmentsTotal;
}
