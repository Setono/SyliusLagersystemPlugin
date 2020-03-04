<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Order;

use Setono\SyliusLagersystemPlugin\View\Order\ItemUnitView;
use Sylius\Component\Core\Model\OrderItemUnitInterface;

interface ItemUnitViewFactoryInterface
{
    public function create(OrderItemUnitInterface $itemUnit, string $localeCode): ItemUnitView;
}
