<?php

return [
    'router' => [
        'routes' => [

        ],
    ],
    'service_manager' => [
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
                'paths' => [__DIR__ . '/../src/Cart/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    'Cart\Entity' => 'CartOrmDriver'
                ],
            ],
        ],
    ]
];
