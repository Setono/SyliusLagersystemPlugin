<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Repository;

use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Core\Repository\OrderRepositoryInterface as BaseOrderRepositoryInterface;

interface OrderRepositoryInterface extends BaseOrderRepositoryInterface
{
    public function createLagersystemListQueryBuilder(): QueryBuilder;
}
