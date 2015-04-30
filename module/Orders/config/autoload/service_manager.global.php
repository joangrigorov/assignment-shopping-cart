<?php

return [
    'service_manager' => [
        'factories' => [
            'Orders\Repository\DiscountCouponsRepository' => function (\Zend\ServiceManager\ServiceLocatorInterface $sm) {
                return $sm->get('Doctrine\ORM\EntityManager')
                    ->getRepository('Orders\Entity\DiscountCoupon');
            },
            'Orders\Repository\OrdersRepository' => function (\Zend\ServiceManager\ServiceLocatorInterface $sm) {
                return $sm->get('Doctrine\ORM\EntityManager')
                    ->getRepository('Orders\Entity\Order');
            },
            'Orders\Form\Checkout' => function () {
                return new \Orders\Form\Checkout(
                    new \Orders\Form\CheckoutFilter(),
                    new \Orders\Hydrator\OrdersHydrator()
                );
            },
        ]
    ]
];