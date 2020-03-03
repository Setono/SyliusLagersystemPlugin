<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory\Loevgaard;

use Loevgaard\SyliusBrandPlugin\Model\BrandInterface;
use Setono\SyliusLagersystemPlugin\View\Loevgaard\BrandView;

interface BrandViewFactoryInterface
{
    public function create(BrandInterface $brand): BrandView;
}
