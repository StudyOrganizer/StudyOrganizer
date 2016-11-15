<?php
namespace StudentUI\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class DashboardController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('StudentUIPermissionService')->hasRightToAccessStudentUI($this)) {
            $this->layout('layout/studentui.phtml');
            $login = new Container('studentui_login');

            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            $user = $em->getRepository('\Application\Entity\User')->findOneById($login->UserID);

            if($user != null) {
                if($user->getStudent()->getLead() != null) {
                    $lead = true;
                } else {
                    $lead = false;
                }
            }

            $firstname = $login->UserFirstname;
            $lastname = $login->UserLastname;
            $location = $login->UserLocation;
            $website = $login->UserHomepage;
            $aboutme = $login->UserAboutMe;

            if (!isset($login->UserID)) {
                return $this->redirect('login');
                die();
            }

            return new ViewModel(array(
                'firstname' => $firstname,
                'lastname' => $lastname,
                'location' => $location,
                'homepage' => $website,
                'aboutme' => $aboutme,
                "avatar" => $user->getAvatar(),
                "lead" => $lead,
                "mute" => $user->getMute(),
                'school' => $user->getStudent()->getSchool()->getName(),
                'courses' => $user->getStudent()->getCourses(),
            ));
        } else {
            return $this->getServiceLocator()->get('StudentUIPermissionService')->performNoPermission($this);
        }
    }
}
