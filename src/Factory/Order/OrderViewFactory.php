<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Order;

use Setono\SyliusLagersystemPlugin\Factory\Address\AddressViewFactoryInterface;
use Setono\SyliusLagersystemPlugin\View\Order\OrderView;
use Sylius\Component\Core\Model\OrderInterface;
use Webmozart\Assert\Assert;

class OrderViewFactory implements OrderViewFactoryInterface
{
    /** @var AddressViewFactoryInterface */
    protected $addressViewFactory;

    /** @var string */
    protected $orderViewClass;

    public function __construct(
        AddressViewFactoryInterface $addressViewFactory,
        string $orderViewClass
    ) {
        $this->addressViewFactory = $addressViewFactory;
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
        $orderView->state = $order->getState();
        $orderView->checkoutState = $order->getCheckoutState();
        $orderView->checkoutCompletedAt = $checkoutCompletedAt->format('c');
        $orderView->paymentState = $order->getPaymentState();

        if (null !== $order->getShippingAddress()) {
            $orderView->shippingAddress = $this->addressViewFactory->create($order->getShippingAddress());
        }

        if (null !== $order->getBillingAddress()) {
            $orderView->billingAddress = $this->addressViewFactory->create($order->getBillingAddress());
        }

        return $orderView;
    }
}
