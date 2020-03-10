<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Repository;

use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Core\Repository\ShipmentRepositoryInterface as BaseShipmentRepositoryInterface;

interface ShipmentRepositoryInterface extends BaseShipmentRepositoryInterface
{
    public function createLagersystemListQueryBuilder(): QueryBuilder;
}
