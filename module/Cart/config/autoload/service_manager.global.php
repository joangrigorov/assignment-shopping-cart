<?php

return [
    'service_manager' => [
        'factories' => [
            'Cart\Repository\CartItemsRepository' => function (\Zend\ServiceManager\ServiceLocatorInterface $sm) {
                return $sm->get('Doctrine\ORM\EntityManager')
                    ->getRepository('Cart\Entity\CartItem');
            },
            'Cart\Utils\CartItemAdder' => function (\Zend\ServiceManager\ServiceLocatorInterface $sm) {
                /** @var \Cart\Repository\CartItemsRepository $repo */
                $repo = $sm->get('Cart\Repository\CartItemsRepository');
                return new \Cart\Utils\CartItemAdder($repo, session_id());
            },
            'Cart\Utils\QuantityUpdater' => function (\Zend\ServiceManager\ServiceLocatorInterface $sm) {
                /** @var \Cart\Repository\CartItemsRepository $repo */
                $repo = $sm->get('Cart\Repository\CartItemsRepository');
                return new \Cart\Utils\QuantityUpdater($repo);
            }
        ]
    ]
];