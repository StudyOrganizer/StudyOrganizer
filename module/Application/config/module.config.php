<?php

namespace Application;

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
            'document_public_overview' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/documents[/:page]',
                    'constraints' => array(
                        'page' => '[0-9]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\PublicDocumentOverview',
                        'action' => 'index',
                    ),
                ),
            ),
            'vocabulary_public_overview' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/vocabularies',
                    'defaults' => array(
                        'controller' => 'Application\Controller\PublicVocabularyOverview',
                        'action' => 'index',
                    ),
                ),
            ),
            'document_pdf_view' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/documents/pdf/:id',
                    'defaults' => array(
                        'controller' => 'Application\Controller\PublicDocumentPDFView',
                        'action' => 'index',
                    ),
                ),
            ),
            'public_help' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/help',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Help',
                        'action' => 'index',
                    ),
                ),
            ),
            'login' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/login',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Login',
                        'action' => 'index',
                    ),
                ),
            ),
            'logout' => array(
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => array(
                                'route' => '/logout',
                                'defaults' => array(
                                        'controller' => 'Application\Controller\Logout',
                                        'action' => 'index',
                                ),
                        ),
            ),
            'public_document_text_view' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/public/documents/:id',
                    'defaults' => array(
                        'controller' => 'Application\Controller\PublicDocumentView',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'doctrine' => array(
          'driver' => array(
          'so_driver' => array(
              'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
              'cache' => 'array',
                  'paths' => array(__DIR__.'/../src/'.__NAMESPACE__.'/Entity'),
              ),
          'orm_default' => array(
              'drivers' => array(
                __NAMESPACE__.'\Entity' => 'so_driver',
              ),
          ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ),
        'invokables' => array(
            'TokenValidationCheckService' => 'Application\Service\TokenValidationCheckService',
        ),
    ),
    'translator' => array(
        'locale' => 'en_GB',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__.'/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Logout' => 'Application\Controller\LogoutController',
            'Application\Controller\Login' => 'Application\Controller\LoginController',
            'Application\Controller\PublicDocumentView' => 'Application\Controller\PublicDocumentViewController',
            'Application\Controller\PublicDocumentPDFView' => 'Application\Controller\PublicDocumentPDFViewController',
            'Application\Controller\Help' => 'Application\Controller\HelpController',
            'Application\Controller\PublicDocumentOverview' => 'Application\Controller\PublicDocumentOverviewController',
            'Application\Controller\PublicVocabularyOverview' => 'Application\Controller\PublicVocabularyOverviewController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__.'/../view/layout/layout.phtml',
            'application/index/index' => __DIR__.'/../view/application/index/index.phtml',
            'error/404' => __DIR__.'/../view/error/404.phtml',
            'error/index' => __DIR__.'/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__.'/../view',
        ),
    ),
    'view_helpers' => array(
        'invokables'=> array(
            'PaginatorHelper' => 'Application\ViewHelper\PaginatorHelper'
        )
    ),
);
