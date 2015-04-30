<?php

return [
    'router' => [
        'routes' => [
            'cart' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/cart[/coupon/:couponCode]',
                    'defaults' => [
                        'controller' => 'Cart\Controller\Index',
                        'action' => 'index'
                    ],
                ]
            ],
            'cart-add' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/cart/add',
                    'defaults' => [
                        'controller' => 'Cart\Controller\Index',
                        'action' => 'add',
                    ],
                ]
            ],
            'cart-update' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/cart/update',
                    'defaults' => [
                        'controller' => 'Cart\Controller\Index',
                        'action' => 'update',
                    ],
                ]
            ],
        ],
    ],
    'controllers' => [
        'invokables' => [
            'Cart\Controller\Index' => 'Cart\Controller\IndexController'
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'doctrine' => [
        'driver' => [
            'CartOrmDriver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Cart']
            ],
            'orm_default' => [
                'drivers' => [
                    'Cart' => 'CartOrmDriver'
                ],
            ],
        ],
    ]
];
