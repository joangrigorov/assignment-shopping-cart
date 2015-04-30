<?php

namespace Orders\Entity;

use Doctrine\ORM\Mapping as ORM;
use Orders\Value\PricePurchased;
use Common\Value\QuantityRequested;
use Products\Entity\Product;

/**
 * Order item entity
 *
 * @ORM\Table(name="order_items", indexes={@ORM\Index(name="fk_order_items_1_idx", columns={"parentOrder"}), @ORM\Index(name="fk_order_items_2_idx", columns={"product"})})
 * @ORM\Entity
 */
class OrderItem
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
     * Purchased quantity
     *
     * @var QuantityRequested
     *
     * @ORM\Embedded(class="\Common\Value\QuantityRequested", columnPrefix = false)
     */
    private $quantityRequested;

    /**
     * Reference to the order to which the item belongs
     *
     * @var \Orders\Entity\Order
     *
     * @ORM\ManyToOne(targetEntity="\Orders\Entity\Order", inversedBy="orderItems")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parentOrder", referencedColumnName="id")
     * })
     */
    private $parentOrder;

    /**
     * Reference to the ordered product
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
     * Exact price on which the product was purchased
     *
     * @var \Orders\Value\PricePurchased
     *
     * @ORM\Embedded(class="\Orders\Value\PricePurchased", columnPrefix = false)
     */
    private $pricePurchased;

    /**
     * Constructor
     *
     * Sets quantity, product and price purchased
     *
     * @param QuantityRequested $quantityRequested
     * @param Product $product
     * @param PricePurchased|null $pricePurchased
     */
    public function __construct(QuantityRequested $quantityRequested,
                                Product $product,
                                PricePurchased $pricePurchased = null)
    {
        $this->quantityRequested = $quantityRequested;
        $this->product = $product;

        if (null === $pricePurchased) {
            $pricePurchased = new PricePurchased($product->getPrice()->getAmount());
        }

        $this->pricePurchased = $pricePurchased;
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
     * @return OrderItem Provides fluent interface
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * Setter for $quantityRequested
     *
     * @param QuantityRequested $quantityRequested
     * @return OrderItem Provides fluent interface
     */
    public function setQuantityRequested(QuantityRequested $quantityRequested)
    {
        $this->quantityRequested = $quantityRequested;
        return $this;
    }

    /**
     * Getter for $order
     *
     * @return Order
     */
    public function getOrder()
    {
        return $this->parentOrder;
    }

    /**
     * Setter for $order
     *
     * @param Order $order
     * @return OrderItem Provides fluent interface
     */
    public function setOrder($order)
    {
        $this->parentOrder = $order;
        return $this;
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
     * @return OrderItem Provides fluent interface
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;
        return $this;
    }

    /**
     * Getter for $pricePurchased
     *
     * @return \Orders\Value\PricePurchased
     */
    public function getPricePurchased()
    {
        return $this->pricePurchased;
    }

    /**
     * Setter for $pricePurchased
     *
     * @param \Orders\Value\PricePurchased $pricePurchased
     * @return OrderItem Provides fluent interface
     */
    public function setPricePurchased(PricePurchased $pricePurchased)
    {
        $this->pricePurchased = $pricePurchased;
        return $this;
    }

    /**
     * Retrieve total price, based on requested quantity
     *
     * @return \Products\Value\Price
     */
    public function getQuantifiedPrice()
    {
        return $this->product->getPrice()->quantify($this->getQuantityRequested());
    }


}

