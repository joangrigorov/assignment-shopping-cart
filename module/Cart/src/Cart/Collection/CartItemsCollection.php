<?php

namespace Cart\Collection;
use Cart\Entity\CartItem;
use Orders\Value\TotalPrice;

/**
 * Collection of cart items
 *
 * Used to get overall information for all items in cart
 *
 * @package Cart\Collection
 */
class CartItemsCollection extends \ArrayObject
{

    /**
     * Sum overall cart items price
     *
     * @return TotalPrice
     */
    public function sumOverallPrice()
    {
        $total = 0;
        /** @var CartItem $item */
        foreach ($this->getIterator() as $item) {
            $total += $item->getQuantifiedPrice()->getAmount();
        }

        return new TotalPrice($total);
    }

}