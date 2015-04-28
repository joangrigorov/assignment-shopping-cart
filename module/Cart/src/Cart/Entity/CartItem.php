<?php

namespace Cart\Entity;

use Common\Value\QuantityRequested;
use Doctrine\ORM\Mapping as ORM;
use Products\Entity\Product;

/**
 * Cart item entity
 *
 * Represents a product added to cart, plus its requested quantity
 *
 * @ORM\Table(name="cart", indexes={@ORM\Index(name="fk_cart_1_idx", columns={"product"}), @ORM\Index(name="session_id", columns={"sessionID"})})
 * @ORM\Entity(repositoryClass=Cart\Repository\CartItems)
 */
class CartItem
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
     * Session ID
     *
     * @var string
     *
     * @ORM\Column(name="sessionID", type="string", length=26, nullable=true)
     */
    private $sessionID;

    /**
     * Quantity to purchase
     *
     * @var QuantityRequested
     *
     * @ORM\Embedded(class="\Common\Value\QuantityRequested")
     */
    private $quantityRequested;

    /**
     * Date/time on which the product has been added to cart
     *
     * @var \DateTimeInterface
     *
     * @ORM\Column(name="dateAdded", type="datetime", nullable=true)
     */
    private $dateAdded;

    /**
     * Reference to the selected product
     *
     * @var \Products\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="\Products\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product", referencedColumnName="id")
     * })
     */
    private $product;

    /**
     * Constructor
     *
     * Sets cart item properties such as session ID, quantity and the product itself
     *
     * @param string $sessionID
     * @param QuantityRequested $quantityRequested
     * @param Product $product
     */
    public function __construct($sessionID, QuantityRequested $quantityRequested, Product $product)
    {
        $this->sessionID = $sessionID;
        $this->quantityRequested = $quantityRequested;
        $this->product = $product;
    }


    /**
     * Getter for $product
     *
     * @return \Products\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Setter for $product
     *
     * @param \Products\Entity\Product $product
     * @return CartItem Provides fluent interface
     */
    public function setProduct($product)
    {
        $this->product = $product;
        return $this;
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
     * @return CartItem Provides fluent interface
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
     * Setter for $sessionID
     *
     * @param string $sessionID
     * @return CartItem Provides fluent interface
     */
    public function setSessionID($sessionID)
    {
        $this->sessionID = $sessionID;
        return $this;
    }

    /**
     * Getter for $quantityRequested
     *
     * @return QuantityRequested
     */
    public function getQuantityRequested()
    {
        return $this->quantityRequested;
    }

    /**
     * Increase quantity with some amount
     *
     * @param QuantityRequested $withAmount
     * @return QuantityRequested
     */
    public function increaseQuantity(QuantityRequested $withAmount)
    {
        $this->setQuantityRequested(
            $this->getQuantityRequested()->increase($withAmount));
        return $this->quantityRequested;
    }

    /**
     * Setter for $quantityRequested
     *
     * @param QuantityRequested $quantityRequested
     * @return CartItem Provides fluent interface
     */
    public function setQuantityRequested(QuantityRequested $quantityRequested)
    {
        $this->quantityRequested = $quantityRequested;
        return $this;
    }

    /**
     * Getter for $dateAdded
     *
     * @return \DateTimeInterface
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    /**
     * Setter for $dateAdded
     *
     * @param \DateTimeInterface $dateAdded
     * @return CartItem Provides fluent interface
     */
    public function setDateAdded(\DateTimeInterface $dateAdded)
    {
        $this->dateAdded = $dateAdded;
        return $this;
    }


}

