<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Order;

use Setono\SyliusLagersystemPlugin\View\Order\ItemUnitView;
use Sylius\Component\Core\Model\OrderItemUnitInterface;

class ItemUnitViewFactory implements ItemUnitViewFactoryInterface
{
    /** @var string */
    private $itemUnitViewClass;

    public function __construct(string $itemUnitViewClass)
    {
        $this->itemUnitViewClass = $itemUnitViewClass;
    }

    public function create(OrderItemUnitInterface $itemUnit, string $localeCode): ItemUnitView
    {
        /** @var ItemUnitView $itemUnitView */
        $itemUnitView = new $this->itemUnitViewClass();
        $itemUnitView->total = $itemUnit->getTotal();
        $itemUnitView->adjustmentsTotal = $itemUnit->getAdjustmentsTotal();

        return $itemUnitView;
    }
}
