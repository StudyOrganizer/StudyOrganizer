<?php

return array(
    'view_manager' => array(
      'template_map' => array(
          'admin/layout' => __DIR__.'/../view/layout/layout.phtml',
        ),
        'template_path_stack' => array(
        __DIR__.'/../view',
        ),
    ),
    'router' => array(
          'routes' => array(
              'admin_dashboard' => array(
              'type' => 'Zend\Mvc\Router\Http\Literal',
              'options' => array(
                  'route' => '/admin',
                  'defaults' => array(
                      'controller' => 'Admin\Controller\Dashboard',
                      'action' => 'index',
                ),
              ),
            ),
            'admin_school_list' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/admin/schools',
                'defaults' => array(
                    'controller' => 'Admin\Controller\School',
                    'action' => 'index',
              ),
            ),
          ),
          'admin_courses_list' => array(
          'type' => 'Zend\Mvc\Router\Http\Literal',
          'options' => array(
              'route' => '/admin/courses',
              'defaults' => array(
                  'controller' => 'Admin\Controller\Cours',
                  'action' => 'index',
            ),
          ),
        ),
          'add_school' => array(
          'type' => 'Zend\Mvc\Router\Http\Literal',
          'options' => array(
              'route' => '/admin/school/add',
              'defaults' => array(
                  'controller' => 'Admin\Controller\AddSchool',
                  'action' => 'index',
            ),
          ),
          ),
          'add_cours' => array(
          'type' => 'Zend\Mvc\Router\Http\Literal',
          'options' => array(
              'route' => '/admin/cours/add',
              'defaults' => array(
                  'controller' => 'Admin\Controller\AddCours',
                  'action' => 'index',
            ),
          ),
          ),
          'add_school_time' => array(
          'type' => 'Zend\Mvc\Router\Http\Literal',
          'options' => array(
              'route' => '/admin/school/time/add',
              'defaults' => array(
                  'controller' => 'Admin\Controller\AddSchoolTime',
                  'action' => 'index',
            ),
          ),
          ),
          'admin_courses_group_list' => array(
          'type' => 'Zend\Mvc\Router\Http\Literal',
          'options' => array(
              'route' => '/admin/cours/groups',
              'defaults' => array(
                  'controller' => 'Admin\Controller\CoursGroup',
                  'action' => 'index',
            ),
          ),
          ),
          'add_cours_group' => array(
          'type' => 'Zend\Mvc\Router\Http\Literal',
          'options' => array(
              'route' => '/admin/cours/group/add',
              'defaults' => array(
                  'controller' => 'Admin\Controller\AddCoursGroup',
                  'action' => 'index',
            ),
          ),
          ),
          'edit_school' => array(
          'type' => 'Zend\Mvc\Router\Http\Segment',
          'options' => array(
              'route' => '/admin/school/edit/:id',
              'defaults' => array(
                  'controller' => 'Admin\Controller\EditSchool',
                  'action' => 'index',
            ),
          ),
          ),
              'edit_coursgroup' => array(
                  'type' => 'Zend\Mvc\Router\Http\Segment',
                  'options' => array(
                      'route' => '/admin/cours/group/edit/:id',
                      'defaults' => array(
                          'controller' => 'Admin\Controller\EditCoursGroup',
                          'action' => 'index',
                      ),
                  ),
              ),
          'delete_school' => array(
          'type' => 'Zend\Mvc\Router\Http\Segment',
          'options' => array(
              'route' => '/admin/school/delete/:id',
              'defaults' => array(
                  'controller' => 'Admin\Controller\DeleteSchool',
                  'action' => 'index',
            ),
          ),
        ),
        'add_permission' => array(
          'type' => 'Zend\Mvc\Router\Http\Literal',
          'options' => array(
              'route' => '/admin/permissions/add',
              'defaults' => array(
                  'controller' => 'Admin\Controller\AddPermission',
                  'action' => 'index',
            ),
          ),
        ),
            'adminui_login' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                            'route' => '/admin/login',
                            'defaults' => array(
                                    'controller' => 'Admin\Controller\Login',
                                    'action' => 'index',
                            ),
                    ),
            ),
        'admin_permissions_list' => array(
          'type' => 'Zend\Mvc\Router\Http\Literal',
          'options' => array(
              'route' => '/admin/permissions',
              'defaults' => array(
                  'controller' => 'Admin\Controller\Permission',
                  'action' => 'index',
            ),
          ),
        ),
        'admin_user_list' => array(
          'type' => 'Zend\Mvc\Router\Http\Literal',
          'options' => array(
              'route' => '/admin/users',
              'defaults' => array(
                  'controller' => 'Admin\Controller\User',
                  'action' => 'index',
            ),
          ),
        ),
        'admin_times_list' => array(
          'type' => 'Zend\Mvc\Router\Http\Literal',
          'options' => array(
              'route' => '/admin/school/time',
              'defaults' => array(
                  'controller' => 'Admin\Controller\SchoolTimes',
                  'action' => 'index',
            ),
          ),
        ),
        'admin_subjects_list' => array(
          'type' => 'Zend\Mvc\Router\Http\Literal',
          'options' => array(
              'route' => '/admin/subjects',
              'defaults' => array(
                  'controller' => 'Admin\Controller\Subjects',
                  'action' => 'index',
            ),
          ),
        ),
        'add_user' => array(
          'type' => 'Zend\Mvc\Router\Http\Literal',
          'options' => array(
              'route' => '/admin/users/add',
              'defaults' => array(
                  'controller' => 'Admin\Controller\AddUser',
                  'action' => 'index',
            ),
          ),
        ),
        'add_subject' => array(
          'type' => 'Zend\Mvc\Router\Http\Literal',
          'options' => array(
              'route' => '/admin/subjects/add',
              'defaults' => array(
                  'controller' => 'Admin\Controller\AddSubject',
                  'action' => 'index',
            ),
          ),
        ),
        'admin_settings' => array(
        'type' => 'Zend\Mvc\Router\Http\Literal',
        'options' => array(
            'route' => '/admin/settings',
            'defaults' => array(
                'controller' => 'Admin\Controller\Setting',
                'action' => 'index',
          ),
        ),
      ),
      'admin_email' => array(
          'type' => 'Zend\Mvc\Router\Http\Literal',
          'options' => array(
              'route' => '/admin/email',
              'defaults' => array(
                  'controller' => 'Admin\Controller\EMailOverview',
                  'action' => 'index',
              ),
          ),
      ),
      'admin_about' => array(
      'type' => 'Zend\Mvc\Router\Http\Literal',
      'options' => array(
          'route' => '/admin/settings/about',
          'defaults' => array(
              'controller' => 'Admin\Controller\About',
              'action' => 'index',
        ),
      ),
    ),
    ),
    ),
    'service_manager' => array(
      'invokables' => array(
        'AdminUIPermissionService' => 'Admin\Service\AdminUIPermissionService',
      ),
    ),
    'controllers' => array(
      'invokables' => array(
        'Admin\Controller\Dashboard' => 'Admin\Controller\DashboardController',
        'Admin\Controller\School' => 'Admin\Controller\SchoolController',
        'Admin\Controller\Cours' => 'Admin\Controller\CoursController',
        'Admin\Controller\AddCours' => 'Admin\Controller\AddCoursController',
        'Admin\Controller\AddCoursGroup' => 'Admin\Controller\AddCoursGroupController',
        'Admin\Controller\Subjects' => 'Admin\Controller\SubjectsController',
        'Admin\Controller\CoursGroup' => 'Admin\Controller\CoursGroupController',
        'Admin\Controller\AddSchool' => 'Admin\Controller\AddSchoolController',
        'Admin\Controller\AddUser' => 'Admin\Controller\AddUserController',
        'Admin\Controller\AddSchoolTime' => 'Admin\Controller\AddSchoolTimeController',
        'Admin\Controller\SchoolTimes' => 'Admin\Controller\SchoolTimesController',
        'Admin\Controller\AddSubject' => 'Admin\Controller\AddSubjectController',
        'Admin\Controller\AddPermission' => 'Admin\Controller\AddPermissionController',
        'Admin\Controller\Login' => 'Admin\Controller\LoginController',
          'Admin\Controller\EditCoursGroup' => 'Admin\Controller\EditCoursGroupController',
          'Admin\Controller\EMailOverview' => 'Admin\Controller\EMailOverviewController',
          'Admin\Controller\EditSchool' => 'Admin\Controller\EditSchoolController',
        'Admin\Controller\DeleteSchool' => 'Admin\Controller\DeleteSchoolController',
        'Admin\Controller\User' => 'Admin\Controller\UserController',
        'Admin\Controller\Permission' => 'Admin\Controller\PermissionController',
        'Admin\Controller\Setting' => 'Admin\Controller\SettingController',
        'Admin\Controller\About' => 'Admin\Controller\AboutController',
      ),
    ),
);
