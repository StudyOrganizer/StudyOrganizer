<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;

class LogoutController extends AbstractActionController
{
    public function indexAction()
    {
        $login = new Container('studentui_login');
        //check if user is logged in
        if (isset($login->UserID)) {
            unset($login->UserID);

            return $this->redirect()->toRoute('home');
        }

        //if user is admin
        $adminlogin = new Container('adminui_login');
        if (isset($adminlogin->UserID)) {
            unset($adminlogin->UserID);

            return $this->redirect()->toRoute('home');
        }

        return $this->redirect()->toRoute('home');
    }
}
