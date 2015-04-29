<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\View\Helper\FlashMessenger;
use Zend\View\HelperPluginManager;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        /** @var HelperPluginManager $viewHelperManager */
        $viewHelperManager = $e->getApplication()->getServiceManager()
            ->get('ViewHelperManager');

        /** @var FlashMessenger $flashMessenger */
        $flashMessenger = $viewHelperManager->get('FlashMessenger');
        $flashMessenger->setMessageOpenFormat('<div%s><p>')
            ->setMessageSeparatorString('</p><p>')
            ->setMessageCloseString('</p></div>');
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
