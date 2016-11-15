<?php
namespace ajax\V1\Rest\Messages;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MessagesResourceFactory implements FactoryInterface
{
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $service = new MessagesService();
        $service->setServiceManager($serviceLocator);
        return $service;
    }

}
