<?php

declare(strict_types=1);

namespace Tests\Setono\SyliusLagersystemPlugin\Application\Repository;

use Setono\SyliusLagersystemPlugin\Repository\ShipmentRepositoryInterface as LagersystemShipmentRepositoryInterface;
use Setono\SyliusLagersystemPlugin\Repository\ShipmentRepositoryTrait as LagersystemShipmentRepositoryTrait;
use Sylius\Bundle\CoreBundle\Doctrine\ORM\ShipmentRepository as BaseShipmentRepository;

class ShipmentRepository extends BaseShipmentRepository implements LagersystemShipmentRepositoryInterface
{
    use LagersystemShipmentRepositoryTrait;
}
