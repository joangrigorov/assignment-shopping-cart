<?php

namespace Cart\Repository;

use Cart\Collection\CartItemsCollection;
use Cart\Entity\CartItem;
use Doctrine\ORM\EntityRepository;
use Products\Entity\Product;

/**
 * Cart items repository
 *
 * @package Cart\Repository
 */
class CartItemsRepository extends EntityRepository implements CartItemsRepositoryInterface
{

    /**
     * Adds cart item to the database
     *
     * @param CartItem $cartItem
     * @return $this Provides fluent interface
     */
    public function save(CartItem $cartItem)
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

    /**
     * Get items in cart by user session
     *
     * @param string $sessionID
     * @return CartItem[]|CartItemsCollection|null
     */
    public function getItemsBySession($sessionID)
    {
        $items = $this->findBy(['sessionID' => $sessionID]);
        return new CartItemsCollection($items);
    }

    /**
     * Find cart item by ID and user session
     *
     * @param integer $id
     * @param string $sessionID
     * @return CartItem
     */
    public function findItemByIDAndSession($id, $sessionID)
    {
        return $this->findOneBy(['id' => $id, 'sessionID' => $sessionID]);
    }
}