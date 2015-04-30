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
            'Orders\Utils\Checkout' => function ($sm) {
                /** @var \Cart\Repository\CartItemsRepositoryInterface $cartItemsRepo */
                $cartItemsRepo = $sm->get('Cart\Repository\CartItemsRepository');
                /** @var \Orders\Repository\OrdersRepository $ordersRepo */
                $ordersRepo = $sm->get('Orders\Repository\OrdersRepository');
                return new \Orders\Utils\Checkout(
                    $cartItemsRepo,
                    $ordersRepo
                );
            },
        ]
    ]
];