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
    ]
];
