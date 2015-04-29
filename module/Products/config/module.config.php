<?php

return [
    'router' => [
        'routes' => [
            'products' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/products',
                    'defaults' => [
                        'controller' => 'Products\Controller\Index',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'products' => [
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => [
                            'route' => '/new',
                            'defaults' => [
                                'action' => 'new',
                            ],
                        ]
                    ],
                ]
            ],
        ],
    ],
    'service_manager' => [
    ],
    'controllers' => [
        'invokables' => [
            'Products\Controller\Index' => 'Products\Controller\IndexController'
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'doctrine' => [
        'driver' => [
            'ProductsOrmDriver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/Products'
                ]
            ],
            'orm_default' => [
                'drivers' => [
                    'Products' => 'ProductsOrmDriver'
                ],
            ],
        ],
    ]
];
