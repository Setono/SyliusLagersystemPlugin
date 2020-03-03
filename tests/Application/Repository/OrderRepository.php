<?php

declare(strict_types=1);

namespace Tests\Setono\SyliusLagersystemPlugin\Application\Repository;

use Setono\SyliusLagersystemPlugin\Repository\OrderRepositoryInterface as LagersystemOrderRepositoryInterface;
use Setono\SyliusLagersystemPlugin\Repository\OrderRepositoryTrait as LagersystemOrderRepositoryTrait;
use Sylius\Bundle\CoreBundle\Doctrine\ORM\OrderRepository as BaseOrderRepository;

class OrderRepository extends BaseOrderRepository implements LagersystemOrderRepositoryInterface
{
    use LagersystemOrderRepositoryTrait;
}
