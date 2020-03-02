<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Order;

use Setono\SyliusLagersystemPlugin\View\Order\OrderView;
use Sylius\Component\Core\Model\OrderInterface;
use Webmozart\Assert\Assert;

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
        $channel = $order->getChannel();
        Assert::notNull($channel);

        $locale = $channel->getDefaultLocale();
        Assert::notNull($locale);

        $checkoutCompletedAt = $order->getCheckoutCompletedAt();
        Assert::notNull($checkoutCompletedAt);

        /** @var OrderView $orderView */
        $orderView = new $this->orderViewClass();
        $orderView->id = $order->getId();
        $orderView->number = $order->getNumber();
        $orderView->channel = $channel->getCode();
        $orderView->currencyCode = $order->getCurrencyCode();
        $orderView->localeCode = $locale->getCode();
        $orderView->state = $order->getPaymentState();
        $orderView->checkoutState = $order->getCheckoutState();
        $orderView->checkoutCompletedAt = $checkoutCompletedAt->format('c');
        $orderView->paymentState = $order->getPaymentState();

        return $orderView;
    }
}
