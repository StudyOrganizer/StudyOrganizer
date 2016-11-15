<?php
namespace StudentUI\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class StudentLeadManagementDashboardController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('StudentUIPermissionService')->hasRightToAccessStudentUI($this)) {
            $this->layout('layout/studentui.phtml');
            $login = new Container('studentui_login');

            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

            $user = $em->getRepository('\Application\Entity\User')->findOneById($login->UserID);

            if($user->getStudent()->getLead() == null) {
                return $this->redirect('studentui_calendar');
                die();
            }

            if (!isset($login->UserID)) {
                return $this->redirect('login');
                die();
            }

            return new ViewModel();
        } else {
            return $this->getServiceLocator()->get('StudentUIPermissionService')->performNoPermission($this);
        }
    }
}
