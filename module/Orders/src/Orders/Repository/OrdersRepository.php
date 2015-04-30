<?php

namespace Orders\Repository;

use Doctrine\ORM\EntityRepository;
use Orders\Entity\Order;

/**
 * Repository for placed orders
 *
 * @package Orders\Repository
 */
class OrdersRepository extends EntityRepository
{

    /**
     * Saves order
     *
     * @param Order $order
     * @return $this
     */
    public function save(Order $order)
    {
        $this->_em->persist($order);

        $orderItems = clone $order->getOrderItems();
        $order->clearOrderItems();
        $this->_em->flush($order);

        foreach ($orderItems as $orderItem) {
            $order->addOrderItem($orderItem);
        }
        $this->_em->flush();

        return $this;
    }

}