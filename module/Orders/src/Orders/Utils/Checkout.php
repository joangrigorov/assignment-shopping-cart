<?php

namespace Orders\Utils;

use Cart\Collection\Cart;
use Cart\Repository\CartItemsRepositoryInterface;
use Orders\Entity\Order;
use Orders\Entity\OrderItem;
use Orders\Repository\OrdersRepository;
use Orders\Value\PricePurchased;
use Orders\Value\ShippingDetails;
use Orders\Value\TotalPrice;

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
     * @param ShippingDetails $shippingDetails
     * @return Order
     */
    public function checkout(Cart $cart, ShippingDetails $shippingDetails)
    {
        $order = $this->createOrderEntityFromCart($cart, $shippingDetails);
        $this->ordersRepository->save($order);
        $this->cartItemsRepository->clearCart($cart->getSessionID());
        return $order;
    }

    /**
     * Factory for orders
     *
     * Creates an order entity and injects items + shipping details
     *
     * @param Cart $cart
     * @param ShippingDetails $shippingDetails
     * @return Order
     */
    private function createOrderEntityFromCart(Cart $cart, ShippingDetails $shippingDetails)
    {
        $orderItems = [];

        foreach ($cart as $cartItem) {
            $orderItems[] = new OrderItem(
                $cartItem->getQuantityRequested(), $cartItem->getProduct(),
                new PricePurchased($cartItem->getProduct()->getPrice()->getAmount())
            );
        }

        $order = new Order($orderItems, $shippingDetails);
        $order->setTotalPrice(new TotalPrice($cart->sumOverallPrice(true)->getAmount()));
        return $order;
    }

}