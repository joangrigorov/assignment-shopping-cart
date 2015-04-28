<?php

namespace Cart\Repository;

use Cart\Entity\CartItem;
use Products\Entity\Product;

/**
 * Interface for cart items repository
 *
 * @package Cart\Repository
 */
interface CartItemsInterface
{

    /**
     * Adds cart item to the database
     *
     * @param CartItem $cartItem
     * @return $this Provides fluent interface
     */
    public function add(CartItem $cartItem);

    /**
     * Find already existing item in cart by session
     *
     * @param string $sessionID
     * @param Product $product
     * @return CartItem
     */
    public function findItemByProductAndSession($sessionID, Product $product);

}