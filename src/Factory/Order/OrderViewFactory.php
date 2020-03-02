<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Order;

use Setono\SyliusLagersystemPlugin\Factory\Address\AddressViewFactoryInterface;
use Setono\SyliusLagersystemPlugin\Factory\Customer\CustomerViewFactoryInterface;
use Setono\SyliusLagersystemPlugin\Factory\PaymentViewFactoryInterface;
use Setono\SyliusLagersystemPlugin\Factory\ShipmentViewFactoryInterface;
use Setono\SyliusLagersystemPlugin\View\Order\OrderView;
use Sylius\Component\Core\Model\CustomerInterface;
use Sylius\Component\Core\Model\OrderInterface;
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

    /** @var string */
    protected $orderViewClass;

    public function __construct(
        CustomerViewFactoryInterface $customerViewFactory,
        AddressViewFactoryInterface $addressViewFactory,
        ShipmentViewFactoryInterface $shipmentViewFactory,
        PaymentViewFactoryInterface $paymentViewFactory,
        string $orderViewClass
    ) {
        $this->customerViewFactory = $customerViewFactory;
        $this->addressViewFactory = $addressViewFactory;
        $this->shipmentViewFactory = $shipmentViewFactory;
        $this->paymentViewFactory = $paymentViewFactory;
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

        foreach ($order->getShipments() as $shipment) {
            $orderView->shipments[] = $this->shipmentViewFactory->create($shipment, $localeCode);
        }

        foreach ($order->getPayments() as $payment) {
            $orderView->payments[] = $this->paymentViewFactory->create($payment, $localeCode);
        }

        if (null !== $order->getShippingAddress()) {
            $orderView->shippingAddress = $this->addressViewFactory->create($order->getShippingAddress());
        }

        if (null !== $order->getBillingAddress()) {
            $orderView->billingAddress = $this->addressViewFactory->create($order->getBillingAddress());
        }

        $orderView->total = $order->getTotal();
        $orderView->customer = $this->customerViewFactory->create($customer);

        return $orderView;
    }
}
