<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory;

use Setono\SyliusLagersystemPlugin\View\PaymentView;
use Sylius\Component\Core\Model\PaymentInterface;

interface PaymentViewFactoryInterface
{
    public function create(PaymentInterface $payment, string $locale): PaymentView;
}
