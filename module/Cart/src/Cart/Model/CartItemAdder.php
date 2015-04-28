<?php

namespace Cart\Model;
use Cart\Entity\CartItem;
use Cart\Repository\CartItemsInterface;
use Products\Entity\Product;
use Common\Value\QuantityRequested;

/**
 * Class CartItemAdder
 *
 * Used to add items to cart
 *
 * @package Cart\Model
 */
class CartItemAdder //implements CartItemAdderInterface
{
    /**
     * Cart items repository
     *
     * @var CartItemsInterface
     */
    private $cartItemsRepository;

    /**
     * Current session ID
     *
     * @var string
     */
    private $sessionID;

    /**
     * Constructor
     *
     * Injects cart items repository
     *
     * @param CartItemsInterface $cartItems
     * @param string $sessionID
     */
    public function __construct(CartItemsInterface $cartItems, $sessionID)
    {
        $this->cartItemsRepository = $cartItems;
        $this->sessionID = $sessionID;
    }

    /**
     * Adds item to cart
     *
     * @param Product $product
     * @param QuantityRequested $quantityRequested
     * @return CartItem
     */
    public function addToCart(Product $product, QuantityRequested $quantityRequested)
    {
        $cartItem = $this->cartItemsRepository->findItemByProductAndSession($this->sessionID, $product);

        if (null == $cartItem) {
            $cartItem = new CartItem($this->sessionID, $quantityRequested, $product);
        } else {
            $cartItem->increaseQuantity($quantityRequested);
        }
        $this->cartItemsRepository->add($cartItem);
        return $cartItem;
    }

}