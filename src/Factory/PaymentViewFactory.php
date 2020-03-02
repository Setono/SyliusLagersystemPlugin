<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory;

use Setono\SyliusLagersystemPlugin\View\PaymentView;
use Sylius\Component\Core\Model\PaymentInterface;
use Sylius\Component\Core\Model\PaymentMethodInterface;
use Webmozart\Assert\Assert;

final class PaymentViewFactory implements PaymentViewFactoryInterface
{
    /** @var PaymentMethodViewFactoryInterface */
    private $paymentMethodViewFactory;

    /** @var string */
    private $paymentViewClass;

    public function __construct(
        PaymentMethodViewFactoryInterface $paymentMethodViewFactory,
        string $paymentViewClass
    ) {
        $this->paymentMethodViewFactory = $paymentMethodViewFactory;
        $this->paymentViewClass = $paymentViewClass;
    }

    public function create(PaymentInterface $payment, string $locale): PaymentView
    {
        /** @var PaymentMethodInterface|null $paymentMethod */
        $paymentMethod = $payment->getMethod();
        Assert::notNull($paymentMethod);

        /** @var PaymentView $paymentView */
        $paymentView = new $this->paymentViewClass();
        $paymentView->state = $payment->getState();
        $paymentView->method = $this->paymentMethodViewFactory->create($paymentMethod, $locale);

        return $paymentView;
    }
}
