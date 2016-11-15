<?php
namespace system\V1\Rest\Documents;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DocumentsResourceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $service = new DocumentsService();
        $service->setServiceManager($serviceLocator);
        return $service;
    }
}
