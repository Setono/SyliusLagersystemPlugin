<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Address;

use Setono\SyliusLagersystemPlugin\View\AddressView;
use Sylius\Component\Core\Model\AddressInterface;

interface AddressViewFactoryInterface
{
    public function create(AddressInterface $address): AddressView;
}
