<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Order;

use Setono\SyliusLagersystemPlugin\View\Order\OrderView;
use Sylius\Component\Core\Model\OrderInterface;

class OrderViewFactory implements OrderViewFactoryInterface
{
    /** @var string */
    protected $orderViewClass;

    public function __construct(
        string $orderViewClass
    ) {
        $this->orderViewClass = $orderViewClass;
    }

    public function create(OrderInterface $order): OrderView
    {
        /** @var OrderView $orderView */
        $orderView = new $this->orderViewClass();
        $orderView->id = $order->getId();
        $orderView->number = $order->getNumber();
        $orderView->channel = $order->getChannel()->getCode();
        $orderView->currencyCode = $order->getCurrencyCode();
        $orderView->localeCode = $order->getChannel()->getDefaultLocale()->getCode();
        $orderView->state = $order->getPaymentState();
        $orderView->checkoutState = $order->getCheckoutState();
        $orderView->checkoutCompletedAt = $order->getCheckoutCompletedAt()->format('c');
        $orderView->paymentState = $order->getPaymentState();

        return $orderView;
    }
}
