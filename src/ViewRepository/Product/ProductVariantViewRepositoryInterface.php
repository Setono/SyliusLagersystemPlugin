<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\ViewRepository\Product;

use Setono\SyliusLagersystemPlugin\Model\PaginatorDetails;
use Setono\SyliusLagersystemPlugin\View\PageView;

interface ProductVariantViewRepositoryInterface
{
    public function getAllPaginated(PaginatorDetails $paginatorDetails, ?string $localeCode): PageView;
}
