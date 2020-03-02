<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Factory;

use Pagerfanta\Pagerfanta;
use Setono\SyliusLagersystemPlugin\View\PageView;

interface PageViewFactoryInterface
{
    public function create(Pagerfanta $pagerfanta, string $route, array $parameters): PageView;
}
