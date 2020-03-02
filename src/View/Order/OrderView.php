<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\View\Order;

class OrderView
{
    /** @var int|null */
    public $id;

    /** @var string|null */
    public $number;

    /** @var string|null */
    public $channel;

    /** @var string|null */
    public $currencyCode;

    /** @var string|null */
    public $localeCode;

    /** @var string|null */
    public $state;

    /** @var string|null */
    public $checkoutState;

    /** @var string|null */
    public $checkoutCompletedAt;

    /** @var string|null */
    public $paymentState;
}
