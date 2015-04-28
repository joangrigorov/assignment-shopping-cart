<?php

namespace Cart\Repository;

use Cart\Entity\CartItem;
use Doctrine\ORM\EntityRepository;
use Products\Entity\Product;

/**
 * Cart items repository
 *
 * @package Cart\Repository
 */
class CartItems extends EntityRepository implements CartItemsInterface
{

    /**
     * Adds cart item to the database
     *
     * @param CartItem $cartItem
     * @return $this Provides fluent interface
     */
    public function add(CartItem $cartItem)
    {
        $this->_em->persist($cartItem);
        $this->_em->flush($cartItem);
        return $this;
    }

    /**
     * Find already existing item in cart by session
     *
     * @param string $sessionID
     * @param Product $product
     * @return CartItem
     */
    public function findItemByProductAndSession($sessionID, Product $product)
    {
        return $this->findOneBy([
            'sessionID' => $sessionID,
            'product' => $product
        ]);
    }
}