<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Shipping;

use Setono\SyliusLagersystemPlugin\Factory\Order\OrderViewFactoryInterface;
use Setono\SyliusLagersystemPlugin\View\Shipping\ShipmentView;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Model\ShipmentInterface;
use Sylius\Component\Shipping\Model\ShipmentUnitInterface;
use Webmozart\Assert\Assert;

class ShipmentViewFactory implements ShipmentViewFactoryInterface
{
    /** @var ShippingMethodViewFactoryInterface */
    protected $shippingMethodViewFactory;

    /** @var ShipmentUnitViewFactoryInterface */
    protected $shipmentUnitViewFactory;

    /** @var OrderViewFactoryInterface */
    protected $orderViewFactory;

    /** @var string */
    protected $shipmentViewClass;

    public function __construct(
        ShippingMethodViewFactoryInterface $shippingMethodViewFactory,
        ShipmentUnitViewFactoryInterface $shipmentUnitViewFactory,
        OrderViewFactoryInterface $orderViewFactory,
        string $shipmentViewClass
    ) {
        $this->shippingMethodViewFactory = $shippingMethodViewFactory;
        $this->shipmentUnitViewFactory = $shipmentUnitViewFactory;
        $this->orderViewFactory = $orderViewFactory;
        $this->shipmentViewClass = $shipmentViewClass;
    }

    public function create(ShipmentInterface $shipment, string $locale): ShipmentView
    {
        /** @var OrderInterface|null $order */
        $order = $shipment->getOrder();
        Assert::notNull($order);

        $shippedAt = $shipment->getShippedAt();

        /** @var ShipmentView $shipmentView */
        $shipmentView = new $this->shipmentViewClass();
        $shipmentView->id = $shipment->getId();
        $shipmentView->state = $shipment->getState();
        $shipmentView->method = $this->shippingMethodViewFactory->create($shipment, $locale);

        /** @var ShipmentUnitInterface $shipmentUnit */
        foreach ($shipment->getUnits() as $shipmentUnit) {
            $shipmentView->units[] = $this->shipmentUnitViewFactory->create($shipmentUnit, $locale);
        }

        $shipmentView->order = $this->orderViewFactory->create($order);
        $shipmentView->tracking = $shipment->getTracking();
        $shipmentView->shippedAt = null !== $shippedAt ? $shippedAt->format('c') : null;

        return $shipmentView;
    }
}
