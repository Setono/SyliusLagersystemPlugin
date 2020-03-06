<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Repository;

use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Core\Repository\ProductVariantRepositoryInterface as BaseProductVariantRepositoryInterface;

interface ProductVariantRepositoryInterface extends BaseProductVariantRepositoryInterface
{
    public function createLagersystemListQueryBuilder(string $locale): QueryBuilder;
}
