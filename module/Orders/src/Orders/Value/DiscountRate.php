<?php

namespace Orders\Value;

use Doctrine\ORM\Mapping as ORM;

/**
 * Value object for discount rates
 *
 * @package Orders\Value
 * @ORM\Embeddable
 */
class DiscountRate
{

    /**
     * Holds the discountRate
     *
     * @var integer
     * @ORM\Column(name="discountRate", type="integer", nullable=false)
     */
    private $discountRate;

    /**
     * Constructor
     *
     * Sets discount rate to the value object
     *
     * @param integer $discountRate Discount percentage
     */
    public function __construct($discountRate)
    {
        if (!is_numeric($discountRate)) {
            throw new InvalidArgumentException('The discount rate should be a numeric value');
        }

        if (!($discountRate > 0 && $discountRate <= 100)) {
            throw new InvalidArgumentException('Discount rate should be a percentage between 0 and 100 (including)');
        }

        $this->discountRate = (int) $discountRate;
    }

    /**
     * Get discount rate
     *
     * @return int
     */
    public function getDiscountRate()
    {
        return (int) $this->discountRate;
    }

    /**
     * Get discount rate as string (adds % at the end)
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getDiscountRate() . '%';
    }

}