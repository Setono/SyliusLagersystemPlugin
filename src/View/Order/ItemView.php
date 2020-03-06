<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\View\Order;

use Setono\SyliusLagersystemPlugin\View\Product\ProductVariantView;

class ItemView
{
    /** @var int|null */
    public $id;

    /** @var int|null */
    public $quantity;

    /** @var int|null */
    public $total;

    /** @var ProductVariantView */
    public $variant;

    /** @var array|ItemUnitView[] */
    public $units;
}
