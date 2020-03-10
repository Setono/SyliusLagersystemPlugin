<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Shipping;

use Setono\SyliusLagersystemPlugin\View\Shipping\ShipmentView;
use Sylius\Component\Core\Model\ShipmentInterface;

interface ShipmentViewFactoryInterface
{
    public function create(ShipmentInterface $shipment, string $locale): ShipmentView;
}
