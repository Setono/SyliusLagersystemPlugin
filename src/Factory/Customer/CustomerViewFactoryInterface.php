<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Customer;

use Setono\SyliusLagersystemPlugin\View\Customer\CustomerView;
use Sylius\Component\Core\Model\CustomerInterface;

interface CustomerViewFactoryInterface
{
    public function create(CustomerInterface $customer): CustomerView;
}
