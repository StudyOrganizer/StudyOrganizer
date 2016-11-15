<?php
namespace Beemo;

use Zend\ModuleManager\ModuleManager;
use Zend\ModuleManager\ModuleEvent;
use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\ModuleManager\Feature\ConsoleBannerProviderInterface;



class Module implements ConsoleBannerProviderInterface
{
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

    /**
     * Returns a string containing a banner text, that describes the module and/or the application.
     * The banner is shown in the console window, when the user supplies invalid command-line parameters or invokes
     * the application with no parameters.
     *
     * The method is called with active Zend\Console\Adapter\AdapterInterface that can be used to directly access Console and send
     * output.
     *
     * @param Console $console
     * @return string|null
     */
    public function getConsoleBanner(Console $console)
    {
        return
            "==------------------------------------------------==\n" .
            "     Beemo Intelligence Help Module, Version 1.0    \n" .
            "==------------------------------------------------==\n";
    }

    public function getConsoleUsage(Console $console)
    {
     return array(
         'send notifications [--format=]' => 'Get active notifications from database and send them via E-Mail and SMS',
     );
    }

}
