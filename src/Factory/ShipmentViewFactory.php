<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory;

use Setono\SyliusLagersystemPlugin\View\ShipmentView;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Model\ShipmentInterface;

class ShipmentViewFactory implements ShipmentViewFactoryInterface
{
    /** @var ShippingMethodViewFactoryInterface */
    protected $shippingMethodViewFactory;

    /** @var string */
    protected $shipmentViewClass;

    public function __construct(
        ShippingMethodViewFactoryInterface $shippingMethodViewFactory,
        string $shipmentViewClass
    ) {
        $this->shippingMethodViewFactory = $shippingMethodViewFactory;
        $this->shipmentViewClass = $shipmentViewClass;
    }

    public function create(ShipmentInterface $shipment, string $locale): ShipmentView
    {
        /** @var OrderInterface $order */
        $order = $shipment->getOrder();

        /** @var ShipmentView $shipmentView */
        $shipmentView = new $this->shipmentViewClass();
        $shipmentView->state = $shipment->getState();
        $shipmentView->method = $this->shippingMethodViewFactory->create($shipment, $locale);

        return $shipmentView;
    }
}
