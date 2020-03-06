<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory;

use Setono\SyliusLagersystemPlugin\View\ShipmentView;
use Sylius\Component\Core\Model\ShipmentInterface;

interface ShipmentViewFactoryInterface
{
    public function create(ShipmentInterface $shipment, string $locale): ShipmentView;
}
