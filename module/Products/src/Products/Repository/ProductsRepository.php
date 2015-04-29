<?php

namespace Products\Repository;

use Doctrine\ORM\EntityRepository;
use Products\Entity\Product;

/**
 * Repository class for product entities
 *
 * @package Products\Repository
 */
class ProductsRepository extends EntityRepository
{

    /**
     * Saves product to the database
     *
     * @param Product $product
     * @return $this Provides fluent interface
     */
    public function save(Product $product)
    {
        $this->_em->persist($product);
        $this->_em->flush($product);
        return $this;
    }

}