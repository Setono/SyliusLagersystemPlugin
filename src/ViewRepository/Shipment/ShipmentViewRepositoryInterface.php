<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\ViewRepository\Shipment;

use Setono\SyliusLagersystemPlugin\Model\PaginatorDetails;
use Setono\SyliusLagersystemPlugin\View\PageView;

interface ShipmentViewRepositoryInterface
{
    public function getAllPaginated(PaginatorDetails $paginatorDetails, ?string $localeCode): PageView;
}
