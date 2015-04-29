<?php

return [
    'service_manager' => [
        'factories' => [
            'Products\Repository\ProductsRepository' => function (\Zend\ServiceManager\ServiceLocatorInterface $sm) {
                return $sm->get('Doctrine\ORM\EntityManager')
                    ->getRepository('Products\Entity\Product');
            },
            'Products\Form\Product' => function () {
                return new \Products\Form\Product(
                    new \Products\Form\ProductFilter(),
                    new \Products\Hydrator\ProductsHydrator()
                );
            },
            'Products\Utils\ProductsBrowser' => function (\Zend\ServiceManager\ServiceLocatorInterface $sm) {
                /** @var \Products\Repository\ProductsRepository $repo */
                $repo = $sm->get('Products\Repository\ProductsRepository');
                return new \Products\Utils\ProductsBrowser(
                    $repo
                );
            },
        ]
    ]
];