<?php

namespace Common\Value;

use Doctrine\ORM\Mapping as ORM;
use Orders\Value\InvalidArgumentException;

/**
 * Value object for purchased item quantity
 *
 * @package Orders\Value
 * @ORM\Embeddable
 */
class QuantityRequested
{

    /**
     * Holds the item quantity
     *
     * @var float
     * @ORM\Column(name="quantityRequested", type="integer", nullable=true)
     */
    private $quantity;

    /**
     * Constructor
     *
     * Sets quantity
     *
     * @param integer $quantity
     */
    public function __construct($quantity)
    {
        if (!is_numeric($quantity)) {
            throw new InvalidArgumentException('Quantity should a numeric value');
        }

        if ($quantity <= 0) {
            throw new InvalidArgumentException('Quantity should be a positive number, higher than zero');
        }

        $this->quantity = $quantity;
    }

    /**
     * Increase quantity with a value
     *
     * @param QuantityRequested $amount
     * @return QuantityRequested
     */
    public function increase(QuantityRequested $amount)
    {
        return new QuantityRequested($this->quantity + $amount->getQuantity());
    }

    /**
     * Getter for $quantity
     *
     * @return float
     */
    public function getQuantity()
    {
        return (int) $this->quantity;
    }

}