<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory;

use Setono\SyliusLagersystemPlugin\View\PaymentMethodView;
use Sylius\Component\Core\Model\PaymentMethodInterface;

interface PaymentMethodViewFactoryInterface
{
    public function create(PaymentMethodInterface $paymentMethod, string $locale): PaymentMethodView;
}
