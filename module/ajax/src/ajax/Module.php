<?php
namespace ajax;

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
                'Messages\V1\MessagesService' => 'ajax\V1\Rest\Messages\MessagesResourceFactory',
                'ajax\V1\Rest\Messages\MessagesResource' => function($sm) {
                    return new \ajax\V1\Rest\Messages\MessagesResource($sm);
                } 
            ),
            'invokables' => array(
                'ajax\V1\Messages\MessagesEntity' => 'ajax\V1\Rest\Messages\MessagesEntity',
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
