<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\View\Product;

class ProductVariantView
{
    /** @var int|null */
    public $id;

    /** @var string|null */
    public $code;

    /** @var string|null */
    public $name;

    /** @var int|null */
    public $weight;

    /** @var int|null */
    public $onHand;

    /** @var array */
    public $images = [];
}
