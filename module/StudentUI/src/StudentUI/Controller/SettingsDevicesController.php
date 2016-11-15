<?php
namespace StudentUI\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;


class SettingsDevicesController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('StudentUIPermissionService')->hasRightToAccessStudentUI($this)) {
            $this->layout('layout/studentui.phtml');
            $login = new Container('studentui_login');
            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            $token_array = $em->getRepository('\Application\Entity\Token')->findAll(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            $avatar = $login->avatar;

            return new ViewModel(array(
                'token_array' => $token_array,
                'email' => md5($login->UserEMAIL),
                'device_array' => array(),
                'avatar' => $avatar
             ));
        } else {
            return $this->getServiceLocator()->get('StudentUIPermissionService')->performNoPermission($this);
        }
    }
}
