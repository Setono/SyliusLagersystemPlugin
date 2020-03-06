<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Repository;

use Doctrine\ORM\QueryBuilder;

trait ProductVariantRepositoryTrait
{
    /**
     * @param string $alias
     * @param string $indexBy The index for the from.
     *
     * @return QueryBuilder
     */
    abstract public function createQueryBuilder($alias, $indexBy = null);

    public function createLagersystemListQueryBuilder(string $locale): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->leftJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->setParameter('locale', $locale)
            ;
    }
}
