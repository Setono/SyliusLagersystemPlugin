<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Shipping;

use Setono\SyliusLagersystemPlugin\Factory\Product\ProductVariantViewFactoryInterface;
use Setono\SyliusLagersystemPlugin\View\Shipping\ShipmentUnitView;
use Sylius\Component\Core\Model\OrderItemUnitInterface;
use Sylius\Component\Core\Model\ProductVariantInterface;
use Sylius\Component\Shipping\Model\ShipmentUnitInterface;
use Webmozart\Assert\Assert;

class ShipmentUnitViewFactory implements ShipmentUnitViewFactoryInterface
{
    /** @var ProductVariantViewFactoryInterface */
    protected $shippableViewFactory;

    /** @var string */
    protected $shipmentUnitViewClass;

    public function __construct(
        ProductVariantViewFactoryInterface $shippableViewFactory,
        string $shipmentUnitViewClass
    ) {
        $this->shippableViewFactory = $shippableViewFactory;
        $this->shipmentUnitViewClass = $shipmentUnitViewClass;
    }

    public function create(ShipmentUnitInterface $shipmentUnit, string $locale): ShipmentUnitView
    {
        /** @var ProductVariantInterface|null $shippable */
        $shippable = $shipmentUnit->getShippable();
        Assert::notNull($shippable);

        /** @var ShipmentUnitView $shipmentUnitView */
        $shipmentUnitView = new $this->shipmentUnitViewClass();
        $shipmentUnitView->shippable = $this->shippableViewFactory->create($shippable, $locale);

        if ($shipmentUnit instanceof OrderItemUnitInterface) {
            $shipmentUnitView->total = $shipmentUnit->getTotal();
            $shipmentUnitView->adjustmentsTotal = $shipmentUnit->getAdjustmentsTotal();
        }

        return $shipmentUnitView;
    }
}
