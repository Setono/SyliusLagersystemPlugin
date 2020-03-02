<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\View\Order;

class OrderView
{
    /** @var int */
    public $id;

    /** @var string */
    public $number;

    /** @var string */
    public $channel;

    /** @var string */
    public $currencyCode;

    /** @var string */
    public $localeCode;

    /** @var string */
    public $state;

    /** @var string */
    public $checkoutState;

    /** @var string */
    public $checkoutCompletedAt;

    /** @var string */
    public $paymentState;
}
