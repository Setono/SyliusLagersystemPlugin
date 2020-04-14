<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Order;

use Setono\SyliusLagersystemPlugin\Factory\Address\AddressViewFactoryInterface;
use Setono\SyliusLagersystemPlugin\Factory\Customer\CustomerViewFactoryInterface;
use Setono\SyliusLagersystemPlugin\Factory\PaymentViewFactoryInterface;
use Setono\SyliusLagersystemPlugin\View\Order\OrderView;
use Sylius\Component\Core\Model\AdjustmentInterface;
use Sylius\Component\Core\Model\CustomerInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Model\PaymentInterface;
use Webmozart\Assert\Assert;

class OrderViewFactory implements OrderViewFactoryInterface
{
    /** @var CustomerViewFactoryInterface */
    protected $customerViewFactory;

    /** @var AddressViewFactoryInterface */
    protected $addressViewFactory;

    /** @var PaymentViewFactoryInterface */
    protected $paymentViewFactory;

    /** @var AdjustmentViewFactoryInterface */
    protected $adjustmentViewFactory;

    /** @var string */
    protected $orderViewClass;

    public function __construct(
        CustomerViewFactoryInterface $customerViewFactory,
        AddressViewFactoryInterface $addressViewFactory,
        PaymentViewFactoryInterface $paymentViewFactory,
        AdjustmentViewFactoryInterface $adjustmentViewFactory,
        string $orderViewClass
    ) {
        $this->customerViewFactory = $customerViewFactory;
        $this->addressViewFactory = $addressViewFactory;
        $this->paymentViewFactory = $paymentViewFactory;
        $this->adjustmentViewFactory = $adjustmentViewFactory;
        $this->orderViewClass = $orderViewClass;
    }

    public function create(OrderInterface $order): OrderView
    {
        $channel = $order->getChannel();
        Assert::notNull($channel);

        $locale = $channel->getDefaultLocale();
        Assert::notNull($locale);

        $localeCode = $locale->getCode();
        Assert::notNull($localeCode);

        $checkoutCompletedAt = $order->getCheckoutCompletedAt();
        Assert::notNull($checkoutCompletedAt);

        /** @var CustomerInterface|null $customer */
        $customer = $order->getCustomer();
        Assert::notNull($customer);

        /** @var OrderView $orderView */
        $orderView = new $this->orderViewClass();
        $orderView->id = $order->getId();
        $orderView->number = $order->getNumber();
        $orderView->channel = $channel->getCode();
        $orderView->currencyCode = $order->getCurrencyCode();
        $orderView->localeCode = $localeCode;
        $orderView->state = $order->getState();
        $orderView->checkoutState = $order->getCheckoutState();
        $orderView->checkoutCompletedAt = $checkoutCompletedAt->format('c');
        $orderView->paymentState = $order->getPaymentState();

        /** @var PaymentInterface $payment */
        foreach ($order->getPayments() as $payment) {
            $orderView->payments[] = $this->paymentViewFactory->create($payment, $localeCode);
        }

        if (null !== $order->getShippingAddress()) {
            $orderView->shippingAddress = $this->addressViewFactory->create($order->getShippingAddress());
        }

        if (null !== $order->getBillingAddress()) {
            $orderView->billingAddress = $this->addressViewFactory->create($order->getBillingAddress());
        }

        $adjustments = [];
        /** @var AdjustmentInterface $adjustment */
        foreach ($order->getAdjustmentsRecursively() as $adjustment) {
            $originCode = $adjustment->getOriginCode();
            $additionalAmount = isset($adjustments[$originCode]) ? $adjustments[$originCode]->amount : 0;

            $adjustments[$originCode] = $this->adjustmentViewFactory->create(
                $adjustment,
                $additionalAmount
            );
        }
        $orderView->adjustments = $adjustments;
        $orderView->adjustmentsTotal = $order->getAdjustmentsTotalRecursively();
        $orderView->itemsTotal = $order->getItemsTotal();
        $orderView->total = $order->getTotal();
        $orderView->customer = $this->customerViewFactory->create($customer);

        return $orderView;
    }
}
