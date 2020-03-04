<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory;

use Setono\SyliusLagersystemPlugin\View\PriceView;

interface PriceViewFactoryInterface
{
    public function create(int $price, string $currency): PriceView;
}
