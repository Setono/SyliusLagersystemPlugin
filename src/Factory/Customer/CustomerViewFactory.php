<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Customer;

use Setono\SyliusLagersystemPlugin\View\Customer\CustomerView;
use Sylius\Component\Core\Model\CustomerInterface;

class CustomerViewFactory implements CustomerViewFactoryInterface
{
    /** @var string */
    protected $customerViewClass;

    public function __construct(string $customerViewClass)
    {
        $this->customerViewClass = $customerViewClass;
    }

    public function create(CustomerInterface $customer): CustomerView
    {
        /** @var CustomerView $customerView */
        $customerView = new $this->customerViewClass();
        $customerView->id = $customer->getId();
        $customerView->firstName = $customer->getFirstName();
        $customerView->lastName = $customer->getLastName();
        $customerView->email = $customer->getEmail();
        $customerView->birthday = $customer->getBirthday();
        $customerView->gender = $customer->getGender();
        $customerView->phoneNumber = $customer->getPhoneNumber();

        return $customerView;
    }
}
