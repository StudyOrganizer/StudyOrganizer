<?php

namespace StudentUI\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class NewVocabularyStackController extends AbstractActionController
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
                $this->addAction($em);

                
            }
            
            return new ViewModel(array());
        } else {
            return $this->getServiceLocator()->get('StudentUIPermissionService')->performNoPermission($this);
        }
    }
    
    public function addAction($em) {
        $rows = $this->getRequest()->getPost()->Rows;
        $name = $this->getRequest()->getPost()->Name;
        $validator = new \Zend\I18n\Validator\IsInt();
        
        $public = $this->getRequest()->getPost()->public;
        $intern = $this->getRequest()->getPost()->intern;
        $private = $this->getRequest()->getPost()->private;


        
        if($rows > 10 || $rows < 2 || !$validator->isValid($rows) || strlen($name) < 2 || strlen($name) > 20) {
            var_dump("Invalid");
        } else {
            if($public == "on") {
                $newShare = new \Application\Entity\ShareVoc();
                $newShare->setPublic(true);
                $newShare->setIntern(false);
                $newShare->setPrivate(false);
                $em->persist($newShare);
                $em->flush();        
               
                $newStack = new \Application\Entity\VocabularyStack();
                $newStack->setName($name);
                $newStack->setUpdated();
                $newStack->setShare($newShare);
                $newStack->setSize($rows);
          
                $em->persist($newStack);
                $em->flush();

                $newShare->setVoc_stack($newStack);
                $em->merge($newShare);
                $em->flush();

                for($i=0; $i<rows; $i++) {
                    $newHead = new \Application\Entity\VocabularyHead();
                    $newHead->setTitle('');
                    $newHead->setVoc_head($newStack);
                    $em->persist($newHead);
                    $em->flush();
                }
                
                $this->flashMessenger()->setNamespace('success')->addMessage('Success :-)');
            } elseif ($intern == "on") {
                
            } elseif ($private == "on") {
                
            }
        }
        
        
        return $this->redirect()->toRoute('studentui_vocabularies');
    }
}
