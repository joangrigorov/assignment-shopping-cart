<?php

return [
    'doctrine' => [
        'driver' => [
            'CommonOrmDriver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Common']
            ],
            'orm_default' => [
                'drivers' => [
                    'Common' => 'CommonOrmDriver'
                ],
            ],
        ],
    ]
];
