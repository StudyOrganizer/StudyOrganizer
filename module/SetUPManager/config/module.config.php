<?php

return array(
        'view_manager' => array(
          'display_exceptions' => true,
            'template_path_stack' => array(
            __DIR__.'/../view',
            ),
        ),
        'router' => array(
          'routes' => array(
              'setupwelcome' => array(
              'type' => 'Zend\Mvc\Router\Http\Literal',
              'options' => array(
                  'route' => '/setup',
                  'defaults' => array(
                      'controller' => 'SetUPManager\Controller\SetUPWelcome',
                      'action' => 'index',
                ),
              ),
            ),
          ),
       ),
        'controllers' => array(
                'invokables' => array(
                        'SetUPManager\Controller\SetUPWelcome' => 'SetUPManager\Controller\SetUPWelcomeController',
                ),
        ),
);
