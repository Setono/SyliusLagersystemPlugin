<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory;

use Setono\SyliusLagersystemPlugin\View\ShippingMethodView;
use Sylius\Component\Core\Model\ShipmentInterface;
use Webmozart\Assert\Assert;

class ShippingMethodViewFactory implements ShippingMethodViewFactoryInterface
{
    /** @var string */
    protected $shippingMethodViewClass;

    public function __construct(
        string $shippingMethodViewClass
    ) {
        $this->shippingMethodViewClass = $shippingMethodViewClass;
    }

    public function create(ShipmentInterface $shipment, string $locale): ShippingMethodView
    {
        $shippingMethod = $shipment->getMethod();
        Assert::notNull($shippingMethod);

        $translation = $shippingMethod->getTranslation($locale);

        /** @var ShippingMethodView $shippingMethodView */
        $shippingMethodView = new $this->shippingMethodViewClass();
        $shippingMethodView->code = $shippingMethod->getCode();
        $shippingMethodView->name = $translation->getName();
        $shippingMethodView->description = $translation->getDescription();

        return $shippingMethodView;
    }
}
