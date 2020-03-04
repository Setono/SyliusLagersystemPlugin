<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Order;

use Setono\SyliusLagersystemPlugin\Factory\Product\ProductVariantViewFactoryInterface;
use Setono\SyliusLagersystemPlugin\View\Order\ItemView;
use Sylius\Component\Core\Model\OrderItemInterface;
use Sylius\Component\Core\Model\OrderItemUnitInterface;

class ItemViewFactory implements ItemViewFactoryInterface
{
    /** @var ProductVariantViewFactoryInterface */
    protected $productVariantViewFactory;

    /** @var ItemUnitViewFactoryInterface */
    protected $itemUnitViewFactory;

    /** @var string */
    protected $itemViewClass;

    public function __construct(
        ProductVariantViewFactoryInterface $productVariantViewFactory,
        ItemUnitViewFactoryInterface $itemUnitViewFactory,
        string $itemViewClass
    ) {
        $this->productVariantViewFactory = $productVariantViewFactory;
        $this->itemUnitViewFactory = $itemUnitViewFactory;
        $this->itemViewClass = $itemViewClass;
    }

    public function create(OrderItemInterface $item, string $localeCode): ItemView
    {
        /** @var ItemView $itemView */
        $itemView = new $this->itemViewClass();
        $itemView->id = $item->getId();
        $itemView->quantity = $item->getQuantity();
        $itemView->total = $item->getTotal();
        $itemView->variant = $this->productVariantViewFactory->create(
            $item->getVariant(),
            $localeCode
        );

        /** @var OrderItemUnitInterface $itemUnit */
        foreach ($item->getUnits() as $itemUnit) {
            $itemView->units[] = $this->itemUnitViewFactory->create(
                $itemUnit,
                $localeCode
            );
        }

        return $itemView;
    }
}
