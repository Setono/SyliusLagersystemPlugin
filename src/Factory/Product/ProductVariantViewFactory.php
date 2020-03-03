<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Product;

use Setono\SyliusLagersystemPlugin\View\Product\ProductVariantView;
use Sylius\Component\Core\Model\ProductVariantInterface;

final class ProductVariantViewFactory implements ProductVariantViewFactoryInterface
{
    /** @var string */
    private $productVariantViewClass;

    public function __construct(string $productVariantViewClass)
    {
        $this->productVariantViewClass = $productVariantViewClass;
    }

    public function create(ProductVariantInterface $variant, string $localeCode): ProductVariantView
    {
        $translation = $variant->getTranslation($localeCode);

        /** @var ProductVariantView $variantView */
        $variantView = new $this->productVariantViewClass();
        $variantView->id = $variant->getId();
        $variantView->code = $variant->getCode();
        $variantView->name = $translation->getName();
        $variantView->weight = (int) ceil(1000 * $variant->getShippingWeight());
        $variantView->onHand = $variant->getOnHand();

        return $variantView;
    }
}
