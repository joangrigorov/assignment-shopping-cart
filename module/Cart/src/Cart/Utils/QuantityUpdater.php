<?php

namespace Cart\Utils;

use Cart\Repository\CartItemsRepositoryInterface;
use Common\Value\QuantityRequested;

/**
 * Class QuantityUpdater
 *
 * Used to update cart item quantities
 *
 * @package Cart\Utils
 */
class QuantityUpdater
{

    /**
     * Cart item entities repository
     *
     * @var CartItemsRepositoryInterface
     */
    private $cartItemsRepository;

    /**
     * Constructor
     *
     * Injects dependencies
     *
     * @param CartItemsRepositoryInterface $cartItemsRepository
     */
    public function __construct(CartItemsRepositoryInterface $cartItemsRepository)
    {
        $this->cartItemsRepository = $cartItemsRepository;
    }

    /**
     * Update cart item quantities
     *
     * @param array $rawRequestParams
     * @param string $sessionID
     */
    public function updateQuantities(array $rawRequestParams, $sessionID)
    {
        foreach ($rawRequestParams as $cartItemID => $quantity) {
            $cartItem = $this->cartItemsRepository->findItemByIDAndSession($cartItemID, $sessionID);
            if (is_null($cartItem)) {
                throw new CartItemNotFoundException('Cart item not found');
            }
            $cartItem->setQuantityRequested(new QuantityRequested($quantity));
            $this->cartItemsRepository->save($cartItem);
        }
    }

}