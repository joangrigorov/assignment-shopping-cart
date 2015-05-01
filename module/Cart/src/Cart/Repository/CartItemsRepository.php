<?php

namespace Cart\Repository;

use Cart\Collection\Cart;
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
     * @return CartItem[]|Cart|null
     */
    public function getItemsBySession($sessionID)
    {
        $items = $this->findBy(['sessionID' => $sessionID]);
        return new Cart($items, $sessionID);
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

    /**
     * Clears all items for a user session
     *
     * @param string $sessionID
     * @return $this Provides fluent interface
     */
    public function clearCart($sessionID)
    {
        $query = $this->createQueryBuilder('p');
        $query->delete()->where('p.sessionID = ?1');
        $query->setParameter(1, $sessionID);
        $query->getQuery()->execute();
        return $this;
    }
}