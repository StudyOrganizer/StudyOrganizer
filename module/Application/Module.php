<?php
namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container;

class Module {

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $application   = $e->getApplication();
        $sm = $application->getServiceManager();

        $locale_session = new Container('locale');
        $locale = $locale_session->locale;
        if(isset($locale)) {
            $locale = $locale_session->locale;
        } else {
            if(substr(\Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']), 0, 2) === "de") {
                $locale_session->locale = "de_DE";
            } else {
                $locale_session->locale = "en_GB";
            }
        }

        $translator = $e->getApplication()->getServiceManager()->get('translator');
        $translator->setLocale($locale)->setFallbackLocale( 'en_GB' );


    }

    public function getConfig()
    {
        return include __DIR__.'/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__.'/src/'.__NAMESPACE__,
                ),
            ),
        );
    }
}