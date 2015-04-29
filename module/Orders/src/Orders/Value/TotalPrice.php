<?php

namespace Orders\Value;

use Doctrine\ORM\Mapping as ORM;

/**
 * Total price value object
 *
 * Immutable representation of monetary values for total order prices.
 *
 * @package Orders\Entity
 * @ORM\Embeddable
 */
class TotalPrice
{

    /**
     * Holds the amount
     *
     * @var float
     * @ORM\Column(name="totalPrice", type="float", precision=12, scale=2, nullable=true)
     */
    private $amount;

    /**
     * Constructor
     *
     * Sets price amount
     *
     * @param float $amount
     */
    public function __construct($amount)
    {
        if (!is_numeric($amount)) {
            throw new InvalidArgumentException('Total price amount should be numeric');
        }

        $this->amount = $amount;
    }

    /**
     * Getter for $amount
     *
     * @return float
     */
    public function getAmount()
    {
        return (float) $this->amount;
    }

    /**
     * Applies discount to price
     *
     * Result is returned as a new value object
     *
     * @param DiscountRate $discountRate
     * @return TotalPrice
     */
    public function applyDiscount(DiscountRate $discountRate)
    {
        $discount = ($discountRate->getDiscountRate() * $this->amount) / 100;
        return new self($this->amount - $discount);
    }

}