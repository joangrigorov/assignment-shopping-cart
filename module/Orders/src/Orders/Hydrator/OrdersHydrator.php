<?php

namespace Orders\Hydrator;

use Orders\Entity\Order;
use Orders\Value\ShippingDetails;
use Zend\Stdlib\Hydrator\ClassMethods;

class OrdersHydrator extends ClassMethods
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
        if (!$object instanceof Order) {
            throw new InvalidArgumentException('Only order entities could be extracted using this hydrator');
        }

        $orderValues = parent::extract($object);

        if (null !== $object->getShippingDetails()) {
            $shippingDetails = parent::extract($object->getShippingDetails());
        } else {
            $shippingDetails = [];
        }

        return array_merge($orderValues, $shippingDetails);
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
        if (!$object instanceof Order) {
            throw new InvalidArgumentException('Only order entities could be hydrated using this hydrator');
        }

        $data['shippingDetails'] = new ShippingDetails(
            $data['firstName'], $data['lastName'], $data['address'], $data['city'],
            $data['country'], $data['phone']);
        return parent::hydrate($data, $object);
    }
}