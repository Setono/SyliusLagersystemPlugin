<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory;

use Setono\SyliusLagersystemPlugin\View\ShippingMethodView;
use Sylius\Component\Core\Model\ShipmentInterface;

interface ShippingMethodViewFactoryInterface
{
    public function create(ShipmentInterface $shipment, string $locale): ShippingMethodView;
}
