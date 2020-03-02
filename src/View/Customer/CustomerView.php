<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\View\Customer;

class CustomerView
{
    /** @var int|null */
    public $id;

    /** @var string|null */
    public $firstName;

    /** @var string|null */
    public $lastName;

    /** @var string|null */
    public $email;

    /** @var \DateTimeInterface|null */
    public $birthday;

    /** @var string|null */
    public $gender;

    /** @var string|null */
    public $phoneNumber;
}
