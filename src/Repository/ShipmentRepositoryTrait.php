<?php

declare(strict_types=1);

namespace Setono\SyliusLagersystemPlugin\Repository;

use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Core\OrderCheckoutStates;
use Sylius\Component\Core\OrderPaymentStates;
use Sylius\Component\Core\OrderShippingStates;

trait ShipmentRepositoryTrait
{
    /**
     * @param string $alias
     * @param string $indexBy The index for the from.
     *
     * @return QueryBuilder
     */
    abstract public function createQueryBuilder($alias, $indexBy = null);

    public function createLagersystemListQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('shipment')
            ->join('shipment.order', 'o')

            ->andWhere('o.checkoutState in (:checkoutStates)')
            ->setParameter('checkoutStates', [
                OrderCheckoutStates::STATE_COMPLETED,
            ])

            ->andWhere('o.shippingState NOT in (:shippingState)')
            ->setParameter('shippingState', [
                OrderShippingStates::STATE_SHIPPED,
            ])

            ->andWhere('o.paymentState in (:paymentState)')
            ->setParameter('paymentState', [
                OrderPaymentStates::STATE_AUTHORIZED,
                OrderPaymentStates::STATE_PARTIALLY_AUTHORIZED,
                OrderPaymentStates::STATE_PAID,
                OrderPaymentStates::STATE_PARTIALLY_PAID,
            ])
            ;
    }
}
