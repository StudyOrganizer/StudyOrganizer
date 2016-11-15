<?php
namespace StudentUI\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;


class SettingsNotificationsController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('StudentUIPermissionService')->hasRightToAccessStudentUI($this)) {
            $this->layout('layout/studentui.phtml');

            $login = new Container('studentui_login');
            $avatar = $login->avatar;

            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');


            return new ViewModel(array(
                "avatar" => $avatar
            ));
        } else {
            return $this->getServiceLocator()->get('StudentUIPermissionService')->performNoPermission($this);
        }
    }
}
