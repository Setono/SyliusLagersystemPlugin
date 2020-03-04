<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Order;

use Setono\SyliusLagersystemPlugin\View\Order\AdjustmentView;
use Sylius\Component\Order\Model\AdjustmentInterface;

interface AdjustmentViewFactoryInterface
{
    public function create(AdjustmentInterface $adjustment, int $additionalAmount, string $currency): AdjustmentView;
}
