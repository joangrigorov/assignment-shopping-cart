<?php

return [
    'router' => [
        'routes' => [
            'checkout' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/checkout',
                    'defaults' => array(
                        'controller' => 'Orders\Controller\Index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => [
                    'preview' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/preview[/coupon/:couponCode]',
                            'defaults' => [
                                'action' => 'checkout-preview',
                            ],
                        ]
                    ]
                ]
            ),
            'order' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/orders',
                    'defaults' => array(
                        'controller' => 'Orders\Controller\Index',
                        'action' => 'orders'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => [
                    'view' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/view/:id',
                            'defaults' => [
                                'action' => 'view',
                            ],
                        ]
                    ]
                ]
            ),
        ],
    ],
    'service_manager' => [
    ],
    'controllers' => [
        'invokables' => [
            'Orders\Controller\Index' => 'Orders\Controller\IndexController'
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'doctrine' => [
        'driver' => [
            'OrdersOrmDriver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Orders']
            ],
            'orm_default' => [
                'drivers' => [
                    'Orders' => 'OrdersOrmDriver'
                ],
            ],
        ],
    ]
];
