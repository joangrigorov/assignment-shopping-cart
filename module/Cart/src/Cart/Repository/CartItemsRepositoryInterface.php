<?php

namespace Cart\Repository;

use Cart\Collection\Cart;
use Cart\Entity\CartItem;
use Products\Entity\Product;

/**
 * Interface for cart items repository
 *
 * @package Cart\Repository
 */
interface CartItemsRepositoryInterface
{

    /**
     * Adds cart item to the database
     *
     * @param CartItem $cartItem
     * @return $this Provides fluent interface
     */
    public function save(CartItem $cartItem);

    /**
     * Find already existing item in cart by session
     *
     * @param string $sessionID
     * @param Product $product
     * @return CartItem
     */
    public function findItemByProductAndSession($sessionID, Product $product);

    /**
     * Get items in cart by user session
     *
     * @param string $sessionID
     * @return CartItem[]|Cart
     */
    public function getItemsBySession($sessionID);

    /**
     * Find cart item by ID and user session
     *
     * @param integer $id
     * @param string $sessionID
     * @return CartItem
     */
    public function findItemByIDAndSession($id, $sessionID);

    /**
     * Clears all items for a user session
     *
     * @param string $sessionID
     * @return $this Provides fluent interface
     */
    public function clearCart($sessionID);

}