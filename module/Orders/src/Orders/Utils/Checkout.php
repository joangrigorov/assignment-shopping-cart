<?php

namespace Orders\Utils;

use Cart\Collection\Cart;
use Cart\Repository\CartItemsRepositoryInterface;
use Orders\Entity\Order;
use Orders\Repository\OrdersRepository;

/**
 * Utility for checkout orders
 *
 * @package Orders\Utils
 */
class Checkout
{

    /**
     * Cart item entities repository
     *
     * @var \Cart\Repository\CartItemsRepositoryInterface
     */
    private $cartItemsRepository;

    /**
     * Orders repository
     *
     * @var \Orders\Repository\OrdersRepository
     */
    private $ordersRepository;

    /**
     * Constructor
     *
     * Injects cart items repository and orders repository
     *
     * @param CartItemsRepositoryInterface $cartItemsRepository
     * @param \Orders\Repository\OrdersRepository $ordersRepository
     */
    public function __construct(CartItemsRepositoryInterface $cartItemsRepository,
                                OrdersRepository $ordersRepository)
    {

        $this->cartItemsRepository = $cartItemsRepository;
        $this->ordersRepository = $ordersRepository;
    }

    /**
     * Performs checkout
     *
     * @param Cart $cart
     * @param Order $order
     * @param string $sessionID
     */
    public function checkout(Cart $cart, Order $order, $sessionID)
    {
        $order->setOrderDate(new \DateTimeImmutable('now'));
        $order->setOrderItemsFromCart($cart);
        $this->ordersRepository->save($order);
        $this->cartItemsRepository->clearCart($sessionID);
    }

}