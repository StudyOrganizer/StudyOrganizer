<?php
namespace StudentUI\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class StudentLeadManagementUserController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('StudentUIPermissionService')->hasRightToAccessStudentUI($this)) {
            $this->layout('layout/studentui.phtml');
            $login = new Container('studentui_login');

            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

            $user = $em->getRepository('\Application\Entity\User')->findOneById($login->UserID);

            if($user->getStudent()->getLead() == null) {
                return $this->redirect('studentui_dashboard');
                die();
            }

            $courses = $user->getStudent()->getLead()->getCourses();
            $user_ids = array();
            $user = array();

            for($g = 0; $g < sizeof($courses); $g++) {
                $members = $courses[$g]->getMembers();
                for ($i = 0; $i < sizeof($members); $i++) {
                    if(!in_array($user_ids[$i], $user_ids)) {
                            $user[] = $members[$i]->getUser();
                    }
                    $user_ids[] = $members[$i]->getUser()->getId();
                }
            }

            if (!isset($login->UserID)) {
                return $this->redirect('login');
                die();
            }

            if ($this->getRequest()->isPost()) {
                $this->processAction($em, $user_ids, $user);
            }

            return new ViewModel(array(
                "user_array" => $user
            ));
        } else {
            return $this->getServiceLocator()->get('StudentUIPermissionService')->performNoPermission($this);
        }
    }

    public function processAction($em, $user_ids) {
        $method = $this->getRequest()->getPost()->method;
        $user_id = $this->getRequest()->getPost()->userid;

        if(in_array($user_id, $user_ids)) {
            $user = $em->getRepository('\Application\Entity\User')->findOneById($user_id);
            if($method == "mute") {
                $user->setMute(true);
            } else {
                $user->setMute(false);
            }
            $em->merge($user);
            $em->flush();
        }
    }
}
