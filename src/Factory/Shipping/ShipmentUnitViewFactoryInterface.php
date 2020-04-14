<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Shipping;

use Setono\SyliusLagersystemPlugin\View\Shipping\ShipmentUnitView;
use Sylius\Component\Shipping\Model\ShipmentUnitInterface;

interface ShipmentUnitViewFactoryInterface
{
    public function create(ShipmentUnitInterface $shipmentUnit, string $locale): ShipmentUnitView;
}
