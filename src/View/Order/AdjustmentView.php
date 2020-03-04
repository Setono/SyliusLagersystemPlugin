<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\View\Order;

use Setono\SyliusLagersystemPlugin\View\PriceView;

class AdjustmentView
{
    /** @var string|null */
    public $name;

    /** @var PriceView */
    public $amount;

    public function __construct()
    {
        $this->amount = new PriceView();
    }
}
