<?php

namespace StudentUI\Service;

use Zend\Session\Container;

/**
 * Handle access to AdminUI.
 */
class StudentUIPermissionService
{
    public function hasRightToAccessStudentUI($context)
    {
        $login = new Container('studentui_login');
        if (isset($login->UserID)) {
            return true;
        } else {
            $login->message = 'You need to sign in';

            return $context->redirect()->toRoute('login');
        }
    }

    public function performNoPermission($context)
    {
        $context->flashMessenger()->setNamespace('error')->addMessage('Sorry Guy, you don\'t have the permission to access StudentUI');

        return $context->redirect()->toRoute('home');
    }
}
