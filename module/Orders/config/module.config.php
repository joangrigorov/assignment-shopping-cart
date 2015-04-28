<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return [
    'router' => [
        'routes' => [

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
    ]
];
