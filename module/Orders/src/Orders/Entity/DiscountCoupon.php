<?php

namespace Orders\Entity;

use Doctrine\ORM\Mapping as ORM;
use Orders\Value\DiscountRate;

/**
 * Discount coupons entity
 *
 * @ORM\Table(name="discount_coupon")
 * @ORM\Entity
 */
class DiscountCoupon
{

    /**
     * Unique sequence identifier
     *
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Coupon code
     *
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=45, nullable=true)
     */
    private $code;

    /**
     * Discount rate (in percentage)
     *
     * @var DiscountRate
     *
     * @ORM\Embedded(class="\Orders\Value\DiscountRate", columnPrefix = false)
     */
    private $discountRate;

    /**
     * Constructor
     *
     * Sets discount code and percentage (rate)
     *
     * @param string $code
     * @param DiscountRate $discountRate
     */
    public function __construct($code, DiscountRate $discountRate)
    {
        $this->code = $code;
        $this->discountRate = $discountRate;
    }

    /**
     * Getter for $id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Setter for $id
     *
     * @param int $id
     * @return DiscountCoupon Provides fluent interface
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Getter for $code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Setter for $code
     *
     * @param string $code
     * @return DiscountCoupon Provides fluent interface
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Getter for $discountRate
     *
     * @return DiscountRate
     */
    public function getDiscountRate()
    {
        return $this->discountRate;
    }

    /**
     * Setter for $discountRate
     *
     * @param DiscountRate $discountRate
     * @return DiscountCoupon Provides fluent interface
     */
    public function setDiscountRate(DiscountRate $discountRate)
    {
        $this->discountRate = $discountRate;
        return $this;
    }



}

