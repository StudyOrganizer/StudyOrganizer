<?php
namespace StudentUI\Controller;

use Application\Entity\Test;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class NewTestController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('StudentUIPermissionService')->hasRightToAccessStudentUI($this)) {
            $this->layout('layout/studentui.phtml');
            $login = new Container('studentui_login');

            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

            if (!isset($login->UserID)) {
                return $this->redirect('login');
                die();
            }
            
            if ($this->getRequest()->isPost()) {                
                $this->proccessTest($login, $em);
            }
            
            return new ViewModel();
        } else {
            return $this->getServiceLocator()->get('StudentUIPermissionService')->performNoPermission($this);
        }
    }
    
    public function proccessTest($login, $em) {
        $title = $this->getRequest()->getPost()["title"];
        $desc = $this->getRequest()->getPost()["desc"];
        $subject_holder_id = $this->getRequest()->getPost()["subject_select"];
        $datetime = \DateTime::createFromFormat("d.m.Y", $this->getRequest()->getPost()["date"]);

        if($title != "" && $desc != "" && $subject_holder_id != "" && $datetime != "") {
            $subject_holder = $em->getRepository('\Application\Entity\TimeTableSubjectHolder')->findOneById($subject_holder_id);

            if($subject_holder->getCours() != null) {

                $newTest = new Test();
                $newTest->setTitle($title);
                $newTest->setDescription($desc);
                $newTest->setCours($subject_holder->getCours());
                $newTest->setExpireDate($datetime);
                $newTest->setUpdated();

                $em->persist($newTest);
                $em->flush();

                $this->flashMessenger()->setNamespace('success')->addMessage("Success");
            } else {
                $this->flashMessenger()->setNamespace('error')->addMessage("Sorry, we can't find any related cours to this subject.");
            }
        } else {
            $this->flashMessenger()->setNamespace('error')->addMessage("Please supply everything");
        }


        return $this->redirect()->toRoute('studentui_calendar');
    }
}
