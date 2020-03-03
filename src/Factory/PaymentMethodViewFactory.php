<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory;

use Setono\SyliusLagersystemPlugin\View\PaymentMethodView;
use Sylius\Component\Core\Model\PaymentMethodInterface;

class PaymentMethodViewFactory implements PaymentMethodViewFactoryInterface
{
    /** @var string */
    protected $paymentMethodViewClass;

    public function __construct(string $paymentMethodViewClass)
    {
        $this->paymentMethodViewClass = $paymentMethodViewClass;
    }

    public function create(PaymentMethodInterface $paymentMethod, string $locale): PaymentMethodView
    {
        $translation = $paymentMethod->getTranslation($locale);

        /** @var PaymentMethodView $paymentMethodView */
        $paymentMethodView = new $this->paymentMethodViewClass();
        $paymentMethodView->code = $paymentMethod->getCode() ?? '';
        $paymentMethodView->name = $translation->getName() ?? '';
        $paymentMethodView->description = $translation->getDescription() ?? '';

        return $paymentMethodView;
    }
}
