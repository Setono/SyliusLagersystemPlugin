<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Order;

use Setono\SyliusLagersystemPlugin\Factory\Address\AddressViewFactoryInterface;
use Setono\SyliusLagersystemPlugin\Factory\Customer\CustomerViewFactoryInterface;
use Setono\SyliusLagersystemPlugin\Factory\PaymentViewFactoryInterface;
use Setono\SyliusLagersystemPlugin\Factory\ShipmentViewFactoryInterface;
use Setono\SyliusLagersystemPlugin\View\Order\OrderView;
use Sylius\Component\Core\Model\AdjustmentInterface;
use Sylius\Component\Core\Model\CustomerInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Model\OrderItemInterface;
use Sylius\Component\Core\Model\PaymentInterface;
use Sylius\Component\Core\Model\ShipmentInterface;
use Webmozart\Assert\Assert;

class OrderViewFactory implements OrderViewFactoryInterface
{
    /** @var CustomerViewFactoryInterface */
    protected $customerViewFactory;

    /** @var AddressViewFactoryInterface */
    protected $addressViewFactory;

    /** @var ShipmentViewFactoryInterface */
    protected $shipmentViewFactory;

    /** @var PaymentViewFactoryInterface */
    protected $paymentViewFactory;

    /** @var AdjustmentViewFactoryInterface */
    protected $adjustmentViewFactory;

    /** @var ItemViewFactoryInterface */
    protected $itemFactory;

    /** @var string */
    protected $orderViewClass;

    public function __construct(
        CustomerViewFactoryInterface $customerViewFactory,
        AddressViewFactoryInterface $addressViewFactory,
        ShipmentViewFactoryInterface $shipmentViewFactory,
        PaymentViewFactoryInterface $paymentViewFactory,
        AdjustmentViewFactoryInterface $adjustmentViewFactory,
        ItemViewFactoryInterface $itemFactory,
        string $orderViewClass
    ) {
        $this->customerViewFactory = $customerViewFactory;
        $this->addressViewFactory = $addressViewFactory;
        $this->shipmentViewFactory = $shipmentViewFactory;
        $this->paymentViewFactory = $paymentViewFactory;
        $this->adjustmentViewFactory = $adjustmentViewFactory;
        $this->itemFactory = $itemFactory;
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
        $orderView->shippingState = $order->getShippingState();
        $orderView->paymentState = $order->getPaymentState();

        /** @var OrderItemInterface $item */
        foreach ($order->getItems() as $item) {
            $orderView->items[] = $this->itemFactory->create(
                $item,
                $localeCode
            );
        }

        /** @var ShipmentInterface $shipment */
        foreach ($order->getShipments() as $shipment) {
            $orderView->shipments[] = $this->shipmentViewFactory->create($shipment, $localeCode);
        }

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
            $additionalAmount = isset($adjustments[$originCode]) ? $adjustments[$originCode]->amount->current : 0;

            $adjustments[$originCode] = $this->adjustmentViewFactory->create($adjustment, $additionalAmount, $order->getCurrencyCode());
        }
        $orderView->adjustments = $adjustments;
        $orderView->total = $order->getTotal();
        $orderView->customer = $this->customerViewFactory->create($customer);

        return $orderView;
    }
}
