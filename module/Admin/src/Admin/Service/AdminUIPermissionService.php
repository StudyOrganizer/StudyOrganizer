<?php

namespace Admin\Service;

use Zend\Session\Container;

/**
 * Handle access to AdminUI.
 */
class AdminUIPermissionService
{
    public function hasRightToAccessAdminUi($context)
    {
        $login = new Container('adminui_login');
        if (isset($login->UserID)) {
            //ToDo: Permission check
            return true;
        } else {
            $login->message = 'You need to sign in';

            return $context->redirect()->toRoute('adminui_login');
        }
    }

    public function performNoPermission($context)
    {
        $context->flashMessenger()->setNamespace('error')->addMessage('Sorry Guy, you don\'t have the permission to access AdminUI');

        return $context->redirect()->toRoute('home');
    }
}
