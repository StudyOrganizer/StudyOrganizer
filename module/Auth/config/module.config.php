<?php

return array(
    'view_manager' => array(
        'template_path_stack' => array(
        __DIR__.'/../view',
        ),
    ),
    'router' => array(
          'routes' => array(
              'register' => array(
              'type' => 'Zend\Mvc\Router\Http\Literal',
              'options' => array(
                  'route' => '/create/new/account',
                  'defaults' => array(
                      'controller' => 'Auth\Controller\Register',
                      'action' => 'index',
                ),
              ),
            ),
        ),
    ),
    'controllers' => array(
      'invokables' => array(
        'Auth\Controller\Register' => 'Auth\Controller\RegisterController',
      ),
    ),
);
