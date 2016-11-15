<?php
namespace system;

use ZF\Apigility\Provider\ApigilityProviderInterface;

class Module implements ApigilityProviderInterface
{
    public function getConfig()
    {
        return include __DIR__.'/../../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Documents\V1\DocumentsService' => 'system\V1\Rest\Documents\DocumentsResourceFactory',
                'system\V1\Rest\Documents\DocumentsResource' => function($sm) {
                    return new \system\V1\Rest\Documents\DocumentsResource($sm);
                }
            ),
            'invokables' => array(
                'system\V1\Documents\DocumentsEntity' => 'system\V1\Rest\Documents\DocumentsEntity',
            )
        );
    }


    public function getAutoloaderConfig()
    {
        return array(
            'ZF\Apigility\Autoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

    public function getHydratorConfig()
    {
        return array(
            'factories' => array(
                'Zend\Stdlib\Hydrator\ClassMethods' => function($sm) {
                    return new \Zend\Stdlib\Hydrator\ClassMethods(false);
                },
            ),
        );
    }
}
