<?php

declare(strict_types=1);

namespace Tests\Setono\SyliusLagersystemPlugin\Controller\Product;

use function Safe\sprintf;
use Sylius\Component\Core\Model\ProductVariantInterface;
use Tests\Setono\SyliusLagersystemPlugin\Application\Entity\ProductVariant;
use Tests\Setono\SyliusLagersystemPlugin\Controller\JsonApiTestCase as BaseJsonApiTestCase;

abstract class JsonApiTestCase extends BaseJsonApiTestCase
{
    protected $defaultFixtureFiles = [
        'api_administrator.yml',
        'shop.yml',
        'payment.yml',
        'shipping.yml',
        'customer.yml',
        'address.yml',
        'product.yml',
        'order.yml',
    ];

    protected function getProductVariantsIndexUrl(?string $localeCode = null): string
    {
        if (null !== $localeCode) {
            return sprintf(
                '/api/lagersystem/product-variants?locale=%s',
                $localeCode
            );
        }

        return '/api/lagersystem/product-variants';
    }

    /**
     * @param ProductVariant|string $variant
     */
    protected function getProductVariantShowUrl($variant, ?string $localeCode = null): string
    {
        if (null !== $localeCode) {
            return sprintf(
                '/api/lagersystem/product-variants/%s?locale=%s',
                $variant instanceof ProductVariantInterface ? $variant->getCode() : $variant,
                $localeCode
            );
        }

        return sprintf(
            '/api/lagersystem/product-variants/%s',
            $variant instanceof ProductVariantInterface ? $variant->getCode() : $variant
        );
    }
}
