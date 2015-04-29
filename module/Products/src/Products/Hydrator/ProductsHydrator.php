<?php

namespace Products\Hydrator;

use Products\Entity\Product;
use Products\Value\Price;
use Products\Value\QuantityAvailable;
use Zend\Stdlib\Hydrator\ClassMethods;

class ProductsHydrator extends ClassMethods
{
    /**
     * Override the constructor
     *
     * Avoid underscore separated keys
     */
    public function __construct()
    {
        parent::__construct(false);
    }

    /**
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     */
    public function extract($object)
    {
        if (!$object instanceof Product) {
            throw new InvalidArgumentException('Only product entities could be extracted using this hydrator');
        }

        $values = parent::extract($object);

        if (isset($values['price'])) {
            $values['price'] = $object->getPrice()->getAmount();
        }

        if (isset($values['quantityAvailable'])) {
            $values['quantityAvailable'] = $object->getQuantityAvailable()->getQuantity();
        }

        return $values;
    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  object $object
     * @return object
     */
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof Product) {
            throw new InvalidArgumentException('Only product entities could be hydrated using this hydrator');
        }

        $data['price'] = new Price($data['price']);
        $data['quantityAvailable'] = new QuantityAvailable($data['quantityAvailable']);
        return parent::hydrate($data, $object);
    }
}