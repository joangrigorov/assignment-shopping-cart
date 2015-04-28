<?php

namespace Products\Value;

use Doctrine\ORM\Mapping as ORM;

/**
 * Value object for available product quantity
 *
 * @package Products\Value
 * @ORM\Embeddable
 */
class QuantityAvailable
{

    /**
     * Holds the product quantity available
     *
     * @var float
     * @ORM\Column(name="quantityAvailable", type="integer", nullable=true)
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
            throw new InvalidArgumentException('Quantity available should a numeric value');
        }

        if ($quantity < 0) {
            throw new InvalidArgumentException('Quantity available should be a positive number or zero');
        }

        $this->quantity = $quantity;
    }

    /**
     * Getter for $quantity
     *
     * @return float
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

}