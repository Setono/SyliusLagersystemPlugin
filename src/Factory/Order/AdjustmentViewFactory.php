<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Order;

use Setono\SyliusLagersystemPlugin\Factory\PriceViewFactoryInterface;
use Setono\SyliusLagersystemPlugin\View\Order\AdjustmentView;
use Sylius\Component\Order\Model\AdjustmentInterface;

class AdjustmentViewFactory implements AdjustmentViewFactoryInterface
{
    /** @var PriceViewFactoryInterface */
    protected $priceViewFactory;

    /** @var string */
    protected $adjustmentViewClass;

    public function __construct(PriceViewFactoryInterface $priceViewFactory, string $adjustmentViewClass)
    {
        $this->priceViewFactory = $priceViewFactory;
        $this->adjustmentViewClass = $adjustmentViewClass;
    }

    public function create(AdjustmentInterface $adjustment, int $additionalAmount, string $currency): AdjustmentView
    {
        /** @var AdjustmentView $adjustmentView */
        $adjustmentView = new $this->adjustmentViewClass();
        $adjustmentView->name = $adjustment->getLabel();
        $adjustmentView->amount = $this->priceViewFactory->create(
            $adjustment->getAmount() + $additionalAmount,
            $currency
        );

        return $adjustmentView;
    }
}
