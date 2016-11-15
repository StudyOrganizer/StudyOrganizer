<?php
namespace StudentUI\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Zend\Escaper\Escaper;

class NewTextDocumentController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('StudentUIPermissionService')->hasRightToAccessStudentUI($this)) {
            $this->layout('layout/studentui.phtml');
            $login = new Container('studentui_login');

            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            $user = $em->getRepository('\Application\Entity\User')->findOneById($login->UserID);


            if (!isset($login->UserID)) {
                return $this->redirect('login');
                die();
            }
            
            if ($this->getRequest()->isPost()) {                
                $this->processDocument($em, $user);
            }

            return new ViewModel();
        } else {
            return $this->getServiceLocator()->get('StudentUIPermissionService')->performNoPermission($this);
        }
    }
    
    public function processDocument($em, $user) {
        $titel = $this->getRequest()->getPost()->titel;
        $content = $this->getRequest()->getPost()->content;

        $escaper = new Escaper('utf-8');
        
        //escape
        $escapedcontent = $escaper->escapeHtml($content);
        if(strlen($titel) > 2 && strlen($titel) < 99 ) {
            $newDocument = new \Application\Entity\Document();
            $newDocument->setContent($escapedcontent);
            $newDocument->setTitle($titel);
            $newDocument->setOwner($user);
            $em->persist($newDocument);
            $em->flush();
        } else {
            $this->flashMessenger()->setNamespace('error')->addMessage("Please enter a valid titel.");
        }

        return $this->redirect()->toRoute('studentui_document_text_new');
    }

}
