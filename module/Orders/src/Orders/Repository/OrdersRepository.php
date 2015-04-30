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
        $this->_em->flush();
        return $this;
    }

    /**
     * Get all orders
     *
     * Desc sorting is used
     *
     * @return Order[]
     */
    public function getAll()
    {
        $query = $this->createQueryBuilder('o');
        $query->orderBy('o.id', 'desc');

        return $query->getQuery()->execute();
    }

    /**
     * Find single order by ID
     *
     * @param integer $id
     * @return null|Order
     */
    public function findByID($id)
    {
        return $this->findOneBy(['id' => $id]);
    }

}