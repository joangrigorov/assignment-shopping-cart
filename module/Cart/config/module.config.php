<?php

return [
    'router' => [
        'routes' => [
            'cart' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/cart',
                    'defaults' => array(
                        'controller' => 'Cart\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => [
                    'add' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/add/:product/:quantity',
                            'defaults' => [
                                'action' => 'add',
                            ],
                        ]
                    ],
                    'update' => [
                        'type' => 'literal',
                        'options' => [
                            'route' => '/update',
                            'defaults' => [
                                'action' => 'update',
                            ],
                        ]
                    ],
                ]
            ),
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
