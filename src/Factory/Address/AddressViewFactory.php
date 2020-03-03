<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Address;

use Setono\SyliusLagersystemPlugin\View\AddressView;
use Sylius\Component\Core\Model\AddressInterface;

class AddressViewFactory implements AddressViewFactoryInterface
{
    /** @var string */
    protected $addressViewClass;

    public function __construct(string $addressViewClass)
    {
        $this->addressViewClass = $addressViewClass;
    }

    public function create(AddressInterface $address): AddressView
    {
        /** @var AddressView $addressView */
        $addressView = new $this->addressViewClass();

        $addressView->firstName = $address->getFirstName();
        $addressView->lastName = $address->getLastName();
        $addressView->countryCode = $address->getCountryCode();
        $addressView->street = $address->getStreet();
        $addressView->city = $address->getCity();
        $addressView->postcode = $address->getPostcode();
        $addressView->provinceCode = $address->getProvinceCode();
        $addressView->provinceName = $address->getProvinceName();
        $addressView->company = $address->getCompany();
        $addressView->phoneNumber = $address->getPhoneNumber();

        return $addressView;
    }
}
