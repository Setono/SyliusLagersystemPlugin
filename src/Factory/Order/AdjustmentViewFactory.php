<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Order;

use Setono\SyliusLagersystemPlugin\View\Order\AdjustmentView;
use Sylius\Component\Order\Model\AdjustmentInterface;

class AdjustmentViewFactory implements AdjustmentViewFactoryInterface
{
    /** @var string */
    protected $adjustmentViewClass;

    public function __construct(string $adjustmentViewClass)
    {
        $this->adjustmentViewClass = $adjustmentViewClass;
    }

    public function create(AdjustmentInterface $adjustment, int $additionalAmount): AdjustmentView
    {
        /** @var AdjustmentView $adjustmentView */
        $adjustmentView = new $this->adjustmentViewClass();
        $adjustmentView->name = $adjustment->getLabel();
        $adjustmentView->amount = $adjustment->getAmount() + $additionalAmount;

        return $adjustmentView;
    }
}
