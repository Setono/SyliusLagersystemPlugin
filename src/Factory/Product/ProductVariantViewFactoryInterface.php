<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Product;

use Setono\SyliusLagersystemPlugin\View\Product\ProductVariantView;
use Sylius\Component\Core\Model\ProductVariantInterface;

interface ProductVariantViewFactoryInterface
{
    public function create(ProductVariantInterface $variant, string $localeCode): ProductVariantView;
}
