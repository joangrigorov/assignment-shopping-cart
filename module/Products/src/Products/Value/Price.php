<?php

namespace Products\Value;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product price value object
 *
 * Immutable representation of monetary values for product prices.
 *
 * @package Products\Entity
 * @ORM\Embeddable
 */
class Price
{

    /**
     * Holds the amount
     *
     * @var float
     * @ORM\Column(name="price", type="float", precision=12, scale=2, nullable=true)
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
            throw new InvalidArgumentException('Product price amount should be numeric');
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

}