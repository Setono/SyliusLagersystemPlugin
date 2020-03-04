<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Product;

use Loevgaard\SyliusBarcodePlugin\Model\BarcodeAwareInterface;
use Loevgaard\SyliusBrandPlugin\Model\BrandAwareInterface;
use Setono\SyliusLagersystemPlugin\Factory\Loevgaard\BrandViewFactoryInterface;
use Setono\SyliusLagersystemPlugin\View\Product\ProductVariantView;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Model\ProductVariantInterface;
use Webmozart\Assert\Assert;

class ProductVariantViewFactory implements ProductVariantViewFactoryInterface
{
    /** @var BrandViewFactoryInterface */
    private $brandViewFactory;

    /** @var string */
    private $productVariantViewClass;

    public function __construct(
        BrandViewFactoryInterface $brandViewFactory,
        string $productVariantViewClass
    ) {
        $this->brandViewFactory = $brandViewFactory;
        $this->productVariantViewClass = $productVariantViewClass;
    }

    public function create(ProductVariantInterface $variant, string $localeCode): ProductVariantView
    {
        $translation = $variant->getTranslation($localeCode);

        $weight = $variant->getShippingWeight();
        if (null !== $weight) {
            $weight = (int) ceil(1000 * $variant->getShippingWeight());
        }

        if ($variant->isTracked()) {
            $onHand = $variant->getOnHand();
        } else {
            $onHand = 1;
        }

        /** @var ProductVariantView $variantView */
        $variantView = new $this->productVariantViewClass();
        $variantView->id = $variant->getId();
        $variantView->code = $variant->getCode();
        $variantView->name = $translation->getName();
        $variantView->weight = $weight;
        $variantView->onHand = $onHand;

        /** @var ProductInterface|BrandAwareInterface|null $product */
        $product = $variant->getProduct();
        Assert::notNull($product);

        if ($product instanceof BrandAwareInterface) {
            $brand = $product->getBrand();
            if (null !== $brand) {
                $variantView->brand = $this->brandViewFactory->create($brand);
            }
        }

        if ($variant instanceof BarcodeAwareInterface) {
            $variantView->barcode = $variant->getBarcode();
        }

        return $variantView;
    }
}
