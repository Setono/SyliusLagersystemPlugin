<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory;

use Setono\SyliusLagersystemPlugin\View\PriceView;

class PriceViewFactory implements PriceViewFactoryInterface
{
    /** @var string */
    protected $priceViewClass;

    public function __construct(string $priceViewClass)
    {
        $this->priceViewClass = $priceViewClass;
    }

    public function create(int $price, string $currency): PriceView
    {
        /** @var PriceView $priceView */
        $priceView = new $this->priceViewClass();
        $priceView->current = $price;
        $priceView->currency = $currency;

        return $priceView;
    }
}
