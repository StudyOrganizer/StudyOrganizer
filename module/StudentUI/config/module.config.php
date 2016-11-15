<?php
return array(
    'view_manager' => array(
      'template_map' => array(
          'student-ui/layout' => __DIR__.'/../view/layout/layout.phtml',
        ),
        'template_path_stack' => array(
        __DIR__.'/../view',
        ),
    ),
    'router' => array(
                'routes' => array(
                    'studentui_dashboard' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route' => '/ui',
                        'defaults' => array(
                            'controller' => 'StudentUI\Controller\Dashboard',
                            'action' => 'index',
                      ),
                    ),
                  ),
                  'studentui_settings' => array(
                          'type' => 'Zend\Mvc\Router\Http\Literal',
                          'options' => array(
                                  'route' => '/myaccount/settings',
                                  'defaults' => array(
                                          'controller' => 'StudentUI\Controller\Settings',
                                          'action' => 'index',
                                  ),
                          ),
                  ),
                 'studentui_settings_devices' => array(
                          'type' => 'Zend\Mvc\Router\Http\Literal',
                          'options' => array(
                                  'route' => '/myaccount/settings/devices',
                                  'defaults' => array(
                                          'controller' => 'StudentUI\Controller\SettingsDevices',
                                          'action' => 'index',
                                  ),
                          ),
                  ),
                'studentui_settings_notifications' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route' => '/myaccount/settings/notifications',
                        'defaults' => array(
                            'controller' => 'StudentUI\Controller\SettingsNotifications',
                            'action' => 'index',
                        ),
                    ),
                ),
                'studentui_settings_skills' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route' => '/myaccount/settings/skills',
                        'defaults' => array(
                            'controller' => 'StudentUI\Controller\SettingsSkills',
                            'action' => 'index',
                        ),
                    ),
                ),
                  'studentui_calendar' => array(
                          'type' => 'Zend\Mvc\Router\Http\Literal',
                          'options' => array(
                                  'route' => '/ui/calendar',
                                  'defaults' => array(
                                          'controller' => 'StudentUI\Controller\Calendar',
                                          'action' => 'index',
                                  ),
                          ),
                  ),
                 'studentui_settings_avatar' => array(
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => array(
                            'route' => '/ui/myaccount/settings/avatar',
                            'defaults' => array(
                                'controller' => 'StudentUI\Controller\SettingsAvatar',
                                'action' => 'index',
                            ),
                        ),
                 ),
                'studentui_calendar_addtimetable' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route' => '/ui/calendar/timetable/add',
                        'defaults' => array(
                            'controller' => 'StudentUI\Controller\AddTimeTable',
                            'action' => 'index',
                        ),
                    ),
                ),
                'studentui_documents' => array(
                                'type' => 'Zend\Mvc\Router\Http\Segment',
                                'options' => array(
                                                'route' => '/ui/documents[/:page]',
                                    'constraints' => array(
                                        'page' => '[0-9]*',
                                    ),
                                                'defaults' => array(
                                                                'controller' => 'StudentUI\Controller\Document',
                                                                'action' => 'index',
                                                ),
                                ),
                ),
                'studentui_help' => array(
                                'type' => 'Zend\Mvc\Router\Http\Literal',
                                'options' => array(
                                                'route' => '/ui/help',
                                                'defaults' => array(
                                                                'controller' => 'StudentUI\Controller\Help',
                                                                'action' => 'index',
                                                ),
                                ),
                ),
                'studentui_vocabularies' => array(
                                'type' => 'Zend\Mvc\Router\Http\Literal',
                                'options' => array(
                                                'route' => '/ui/vocabularies',
                                                'defaults' => array(
                                                                'controller' => 'StudentUI\Controller\Vocabulary',
                                                                'action' => 'index',
                                                ),
                                ),
                ),
                'studentui_document_upload' => array(
                                'type' => 'Zend\Mvc\Router\Http\Literal',
                                'options' => array(
                                                'route' => '/ui/documents/new/upload',
                                                'defaults' => array(
                                                    'controller' => 'StudentUI\Controller\UploadDocument',
                                                    'action' => 'index',
                                                ),
                                ),
                ),
                'studentui_homework_new' => array(
                                'type' => 'Zend\Mvc\Router\Http\Literal',
                                'options' => array(
                                                'route' => '/ui/calendar/homeworks/new',
                                                'defaults' => array(
                                                                'controller' => 'StudentUI\Controller\NewHomework',
                                                                'action' => 'index',
                                                ),
                                ),
                ),
                'studentui_lead_dashboard' => array(
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => array(
                            'route' => '/management',
                            'defaults' => array(
                                'controller' => 'StudentUI\Controller\StudentLeadManagementDashboard',
                                'action' => 'index',
                            ),
                        ),
                    ),
                    'studentui_lead_user' => array(
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => array(
                            'route' => '/management/user',
                            'defaults' => array(
                                'controller' => 'StudentUI\Controller\StudentLeadManagementUser',
                                'action' => 'index',
                            ),
                        ),
                    ),
                'studentui_test_new' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route' => '/ui/calendar/tests/new',
                        'defaults' => array(
                            'controller' => 'StudentUI\Controller\NewTest',
                            'action' => 'index',
                        ),
                    ),
                ),
                'studentui_document_text_new' => array(
                                'type' => 'Zend\Mvc\Router\Http\Literal',
                                'options' => array(
                                                'route' => '/ui/documents/new/text',
                                                'defaults' => array(
                                                                'controller' => 'StudentUI\Controller\NewTextDocument',
                                                                'action' => 'index',
                                                ),
                                ),
                ),
                'studentui_document_text_view' => array(
                    'type' => 'Zend\Mvc\Router\Http\Segment',
                    'options' => array(
                        'route' => '/ui/documents/text/:id',
                        'defaults' => array(
                            'controller' => 'StudentUI\Controller\ViewTextDocument',
                            'action' => 'index',
                        ),
                    ),
                ),
                'studentui_document_pdf_view' => array(
                    'type' => 'Zend\Mvc\Router\Http\Segment',
                    'options' => array(
                        'route' => '/ui/documents/pdf/:id',
                        'defaults' => array(
                            'controller' => 'StudentUI\Controller\ViewPDFDocument',
                            'action' => 'index',
                        ),
                    ),
                ),
                'studentui_document_text_edit' => array(
                    'type' => 'Zend\Mvc\Router\Http\Segment',
                    'options' => array(
                        'route' => '/ui/documents/edit/:id',
                        'defaults' => array(
                            'controller' => 'StudentUI\Controller\EditTextDocument',
                            'action' => 'index',
                        ),
                    ),
                ),
                'studentui_document_share' => array(
                    'type' => 'Zend\Mvc\Router\Http\Segment',
                    'options' => array(
                        'route' => '/ui/documents/share/:id',
                        'defaults' => array(
                            'controller' => 'StudentUI\Controller\ShareDocument',
                            'action' => 'index',
                        ),
                    ),
                ),
                'studentui_view_homework' => array(
                         'type' => 'Zend\Mvc\Router\Http\Segment',
                         'options' => array(
                             'route' => '/ui/calendar/homework/:id',
                             'defaults' => array(
                                 'controller' => 'StudentUI\Controller\HomeworkView',
                                 'action' => 'index',
                         )
                     )
                 ),
                'studentui_view_vocabularies' => array(
                         'type' => 'Zend\Mvc\Router\Http\Segment',
                         'options' => array(
                             'route' => '/ui/vocabularies/stack/:id',
                             'defaults' => array(
                                 'controller' => 'StudentUI\Controller\Vocabularies',
                                 'action' => 'index',
                         )
                     )
                 ),
                'studentui_view_test' => array(
                    'type' => 'Zend\Mvc\Router\Http\Segment',
                    'options' => array(
                        'route' => '/ui/calendar/test/:id',
                        'defaults' => array(
                            'controller' => 'StudentUI\Controller\TestView',
                            'action' => 'index',
                        )
                    )
                ),
                'voc_stack_new' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route' => '/ui/vocabularies/stack/new',
                        'defaults' => array(
                                        'controller' => 'StudentUI\Controller\NewVocabularyStack',
                                        'action' => 'index',
                        ),
                    ),
                ),
                'voc_new' => array(
                    'type' => 'Zend\Mvc\Router\Http\Segment',
                    'options' => array(
                        'route' => '/ui/vocabularies/stack/:id/new',
                        'defaults' => array(
                            'controller' => 'StudentUI\Controller\NewVocabulary',
                            'action' => 'index',
                        ),
                    ),
                ),
                'studentui_tools' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route' => '/ui/tools',
                        'defaults' => array(
                            'controller' => 'StudentUI\Controller\Tools',
                            'action' => 'index',
                        ),
                    ),
                ),
        ),
    ),
    'service_manager' => array(
      'invokables' => array(
        'StudentUIPermissionService' => 'StudentUI\Service\StudentUIPermissionService',
      ),
    ),
    'controllers' => array(
      'invokables' => array(
            'StudentUI\Controller\Dashboard' => 'StudentUI\Controller\DashboardController',
            'StudentUI\Controller\Settings' => 'StudentUI\Controller\SettingsController',
            'StudentUI\Controller\AddTimeTable' => 'StudentUI\Controller\AddTimeTableController',
            'StudentUI\Controller\Calendar' => 'StudentUI\Controller\CalendarController',
            'StudentUI\Controller\SettingsNotifications' => 'StudentUI\Controller\SettingsNotificationsController',
            'StudentUI\Controller\SettingsSkills' => 'StudentUI\Controller\SettingsSkillsController',
            'StudentUI\Controller\UploadDocument' => 'StudentUI\Controller\UploadDocumentController',
            'StudentUI\Controller\Help' => 'StudentUI\Controller\HelpController',
            'StudentUI\Controller\Vocabulary' => 'StudentUI\Controller\VocabularyStackController',
            'StudentUI\Controller\Document' => 'StudentUI\Controller\DocumentController',  
            'StudentUI\Controller\NewHomework' => 'StudentUI\Controller\NewHomeworkController',  
            'StudentUI\Controller\NewVocabularyStack' => 'StudentUI\Controller\NewVocabularyStackController',
            'StudentUI\Controller\NewVocabulary' => 'StudentUI\Controller\NewVocabularyController',
            'StudentUI\Controller\NewTextDocument' => 'StudentUI\Controller\NewTextDocumentController',
            'StudentUI\Controller\ViewTextDocument' => 'StudentUI\Controller\ViewTextDocumentController',
            'StudentUI\Controller\ViewPDFDocument' => 'StudentUI\Controller\ViewPDFDocumentController',
            'StudentUI\Controller\EditTextDocument' => 'StudentUI\Controller\EditTextDocumentController',
            'StudentUI\Controller\ShareDocument' => 'StudentUI\Controller\ShareDocumentController',
            'StudentUI\Controller\NewTest' => 'StudentUI\Controller\NewTestController',
            'StudentUI\Controller\SettingsDevices' => 'StudentUI\Controller\SettingsDevicesController',
            'StudentUI\Controller\Tools' => 'StudentUI\Controller\ToolsController',
            'StudentUI\Controller\TestView' => 'StudentUI\Controller\TestViewController',
            'StudentUI\Controller\SettingsAvatar' => 'StudentUI\Controller\SettingsAvatarController',
            'StudentUI\Controller\HomeworkView' => 'StudentUI\Controller\HomeworkViewController',
            'StudentUI\Controller\Vocabularies' => 'StudentUI\Controller\VocabulariesController',
            'StudentUI\Controller\StudentLeadManagementDashboard' => 'StudentUI\Controller\StudentLeadManagementDashboardController',
            'StudentUI\Controller\StudentLeadManagementUser' => 'StudentUI\Controller\StudentLeadManagementUserController',
      ),
    ),
);