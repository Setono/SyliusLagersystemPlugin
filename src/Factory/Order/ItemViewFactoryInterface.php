<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Order;

use Setono\SyliusLagersystemPlugin\View\Order\ItemView;
use Sylius\Component\Core\Model\OrderItemInterface;

interface ItemViewFactoryInterface
{
    public function create(OrderItemInterface $item, string $localeCode): ItemView;
}
