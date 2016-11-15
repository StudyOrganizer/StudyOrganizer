<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $login = new Container('studentui_login');
        //check if user is already logged in
        if (isset($login->UserID)) {
            return $this->redirect()->toRoute('studentui_dashboard');
        }

        $result = new ViewModel();
        return $result;
    }
}
