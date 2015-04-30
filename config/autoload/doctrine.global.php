<?php

$sapi = PHP_SAPI == 'cli' ? 'cli' : 'http';

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => [
                    'charset' => 'utf8'
                ]
            ]
        ],

        'configuration' => [
            'orm_default' => [
                'proxyDir' => 'data/' . $sapi
            ],
            'odm_default' => [
                'proxyDir' => 'data/' . $sapi,
                'hydratorDir' => 'data/' . $sapi
            ]
        ],
    ]
];