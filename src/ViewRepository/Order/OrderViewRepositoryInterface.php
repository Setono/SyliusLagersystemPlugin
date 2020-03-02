<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\ViewRepository\Order;

use Setono\SyliusLagersystemPlugin\Model\PaginatorDetails;
use Setono\SyliusLagersystemPlugin\View\PageView;

interface OrderViewRepositoryInterface
{
    public function getAllPaginated(PaginatorDetails $paginatorDetails): PageView;
}
