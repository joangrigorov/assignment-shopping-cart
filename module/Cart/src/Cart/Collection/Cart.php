<?php

namespace Cart\Collection;
use Cart\Entity\CartItem;
use Orders\Entity\DiscountCoupon;
use Orders\Value\DiscountRate;
use Orders\Value\TotalPrice;

/**
 * Collection of cart items
 *
 * Used to get overall information for all items in cart
 *
 * @package Cart\Collection
 */
class Cart extends \ArrayObject
{

    /**
     * Discount coupon (if any)
     *
     * @var DiscountCoupon
     */
    private $discountCoupon;

    /**
     * Session ID, associated with the cart
     *
     * @var string
     */
    private $sessionID;

    /**
     * Setter for $discountCoupon
     *
     * @param DiscountCoupon $discountCoupon
     * @return Cart Provides fluent interface
     */
    public function setDiscountCoupon(DiscountCoupon $discountCoupon)
    {
        $this->discountCoupon = $discountCoupon;
        return $this;
    }

    /**
     * Getter for $discountCoupon
     *
     * @return DiscountCoupon
     */
    public function getDiscountCoupon()
    {
        return $this->discountCoupon;
    }

    /**
     * Is there any discount set?
     *
     * @return bool
     */
    public function hasDiscount()
    {
        return null != $this->discountCoupon;
    }

    /**
     * Getter for $sessionID
     *
     * @return string
     */
    public function getSessionID()
    {
        return $this->sessionID;
    }

    /**
     * Constructor
     *
     * Sets items and session ID
     *
     * @param CartItem[] $input
     * @param string $sessionID
     */
    public function __construct($input = null, $sessionID)
    {
        $this->sessionID = $sessionID;
        parent::__construct($input);
    }

    /**
     * Sum overall cart items price
     *
     * @param bool $useCoupon Should it apply discount?
     * @return TotalPrice
     */
    public function sumOverallPrice($useCoupon = false)
    {
        $totalSum = 0;
        /** @var CartItem $item */
        foreach ($this->getIterator() as $item) {
            $totalSum += $item->getQuantifiedPrice()->getAmount();
        }

        $totalPrice = new TotalPrice($totalSum);

        if ($useCoupon && null != $this->discountCoupon) {
            return $totalPrice->applyDiscount($this->discountCoupon->getDiscountRate());
        }
        return $totalPrice;
    }

}