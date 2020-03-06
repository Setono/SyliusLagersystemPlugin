<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Order;

use Setono\SyliusLagersystemPlugin\View\Order\OrderView;
use Sylius\Component\Core\Model\OrderInterface;

interface OrderViewFactoryInterface
{
    public function create(OrderInterface $order): OrderView;
}
