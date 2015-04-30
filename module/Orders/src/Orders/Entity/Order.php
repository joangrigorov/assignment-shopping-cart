<?php

namespace Orders\Entity;

use Cart\Collection\Cart;
use Cart\Entity\CartItem;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Orders\Value\PricePurchased;
use Orders\Value\ShippingDetails;
use Orders\Value\TotalPrice;

/**
 * Order entity
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="\Orders\Repository\OrdersRepository")
 */
class Order
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
     * Date/Time of creation
     *
     * Uses value object, should be immutable (e.g. DateTimeImmutable)
     *
     * @var \DateTimeInterface
     *
     * @ORM\Column(name="orderDate", type="datetime", nullable=true)
     */
    private $orderDate;

    /**
     * Total price
     *
     * @var \Orders\Value\TotalPrice
     *
     * @ORM\Embedded(class="\Orders\Value\TotalPrice", columnPrefix = false)
     */
    private $totalPrice;

    /**
     * Collection of all items in the order
     *
     * @var OrderItem[]|ArrayCollection|array
     *
     * @ORM\OneToMany(targetEntity="\Orders\Entity\OrderItem", mappedBy="`order`",cascade={"persist"})
     */
    private $orderItems;

    /**
     * Total price
     *
     * @var \Orders\Value\ShippingDetails
     *
     * @ORM\Embedded(class="\Orders\Value\ShippingDetails", columnPrefix = false)
     */
    private $shippingDetails;

    /**
     * Constructor
     *
     * Sets order items in order
     *
     * @param OrderItem[] $orderItems
     * @param ShippingDetails $shippingDetails
     */
    public function __construct(array $orderItems, ShippingDetails $shippingDetails)
    {
        $this->orderDate = new \DateTimeImmutable('now');
        $this->setOrderItems($orderItems);
        $this->totalPrice = $this->recalculateTotalPrice();
        $this->shippingDetails = $shippingDetails;
    }

    /**
     * Re-calculates total price based on order items
     *
     * @return TotalPrice
     */
    private function recalculateTotalPrice()
    {
        $total = 0;
        foreach ($this->orderItems as $orderItem) {
            $total += $orderItem->getPricePurchased()->getAmount();
        }
        return new TotalPrice($total);
    }

    /**
     * Clears all registered order items
     *
     * @return $this Provides fluent interface
     */
    public function clearOrderItems()
    {
        $this->orderItems = [];
        return $this;
    }

    /**
     * Adds an item to the order
     *
     * @param OrderItem $orderItem
     * @return $this Provides fluent interface
     */
    public function addOrderItem(OrderItem $orderItem)
    {
        if (empty($this->orderItems)) {
            $this->orderItems = new ArrayCollection();
        }

        $orderItem->setOrder($this);
        $this->orderItems[] = $orderItem;
        return $this;
    }

    /**
     * Adds multiple items to the order at once
     *
     * @param array $orderItems
     * @throws InvalidArgumentException
     * @return $this Provides fluent interface
     */
    public function addOrderItems($orderItems)
    {
        if (!is_array($orderItems) && !$orderItems instanceof ArrayCollection) {
            throw new InvalidArgumentException('Invalid order items provided');
        }

        foreach ($orderItems as $orderItem) {
            $this->addOrderItem($orderItem);
        }
        return $this;
    }

    /**
     * Removes all registered items and sets new
     *
     * @param OrderItem[]|ArrayCollection $orderItems
     * @throws InvalidArgumentException
     * @return $this Provides fluent interface
     */
    public function setOrderItems($orderItems)
    {
        if (!is_array($orderItems) && !$orderItems instanceof ArrayCollection) {
            throw new InvalidArgumentException('Invalid order items provided');
        }

        $this->clearOrderItems()
             ->addOrderItems($orderItems);
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
     * @return Order Provides fluent interface
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Getter for $orderDate
     *
     * @return \DateTimeInterface
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * Setter for $orderDate
     *
     * @param \DateTimeInterface $orderDate
     * @return Order Provides fluent interface
     */
    public function setOrderDate(\DateTimeInterface $orderDate)
    {
        $this->orderDate = $orderDate;
        return $this;
    }

    /**
     * Getter for $totalPrice
     *
     * @return TotalPrice
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * Setter for $totalPrice
     *
     * @param TotalPrice $totalPrice
     * @return Order Provides fluent interface
     */
    public function setTotalPrice(TotalPrice $totalPrice)
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }

    /**
     * Getter for $orderItems
     *
     * @return array|ArrayCollection|OrderItem[]
     */
    public function getOrderItems()
    {
        return $this->orderItems;
    }

    /**
     * Getter for $shippingDetails
     *
     * @return ShippingDetails
     */
    public function getShippingDetails()
    {
        return $this->shippingDetails;
    }

    /**
     * Setter for $shippingDetails
     *
     * @param ShippingDetails $shippingDetails
     * @return Order Provides fluent interface
     */
    public function setShippingDetails(ShippingDetails $shippingDetails)
    {
        $this->shippingDetails = $shippingDetails;
        return $this;
    }

    /**
     * Sets order items from cart collection
     *
     * @param Cart|CartItem[] $cart
     * @return $this Provides fluent interface
     */
    public function setOrderItemsFromCart(Cart $cart)
    {
        foreach ($cart as $item) {
            $this->addOrderItem(new OrderItem(
                $item->getQuantityRequested(), $item->getProduct(),
                new PricePurchased($item->getProduct()->getPrice()->getAmount())
            ));
        }

        // set the total price using discount
        // TODO: maybe not the best place to put, needs to move
        $this->setTotalPrice(new TotalPrice($cart->sumOverallPrice(true)->getAmount()));
        return $this;
    }

}

