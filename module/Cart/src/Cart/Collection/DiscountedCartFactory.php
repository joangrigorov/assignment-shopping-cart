<?php

namespace Cart\Collection;

use Cart\Repository\CartItemsRepositoryInterface;
use Orders\Repository\DiscountCouponsRepository;

/**
 * Factory, which fetches cart from the database and applies discount (if any) to it
 *
 * @package Cart\Collection
 */
class DiscountedCartFactory
{
    /**
     * Cart items repository
     *
     * @var CartItemsRepositoryInterface
     */
    private $cartItemsRepository;

    /**
     * Discount coupons repository
     *
     * @var DiscountCouponsRepository
     */
    private $discountCouponsRepository;

    /**
     * Constructor
     *
     * Injects repositories as dependencies
     *
     * @param CartItemsRepositoryInterface $cartItemsRepository
     * @param DiscountCouponsRepository $discountCouponsRepository
     */
    public function __construct(CartItemsRepositoryInterface $cartItemsRepository,
                                DiscountCouponsRepository $discountCouponsRepository)
    {

        $this->cartItemsRepository = $cartItemsRepository;
        $this->discountCouponsRepository = $discountCouponsRepository;
    }

    /**
     * Get's cart collection and resolved discount
     *
     * @param string $sessionID
     * @param string $couponCode
     * @return Cart|\Cart\Entity\CartItem[]
     */
    public function getCartWithDiscount($sessionID, $couponCode)
    {
        $cart = $this->cartItemsRepository->getItemsBySession($sessionID);

        if ($couponCode !== false) {
            $coupon = $this->discountCouponsRepository->findByCode($couponCode);
            if (null !== $coupon) {
                $cart->setDiscountCoupon($coupon);
            }
        }

        return $cart;
    }

}