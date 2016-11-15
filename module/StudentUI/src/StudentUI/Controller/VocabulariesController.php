<?php

namespace StudentUI\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class VocabulariesController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('StudentUIPermissionService')->hasRightToAccessStudentUI($this)) {
            $this->layout('layout/studentui.phtml');
            $login = new Container('studentui_login');

            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            
            $stack_id = $this->getEvent()->getRouteMatch()->getParam('id');
            $vocabularies = $em->getRepository('\Application\Entity\VocabularyStack')->findOneBy(array("id" => $stack_id));
            
            if (!isset($login->UserID)) {
                return $this->redirect('login');
                die();
            }
           
            $voc_holder[] = array();         
            
            $for_counter = sizeOf($vocabularies->getVoc()) / $vocabularies->getSize();

            for($i = 0; $i < $for_counter; $i++) {
                $index_counter = $i+1;                
                $vocabularies_db = $em->getRepository('\Application\Entity\Vocabulary')->findBy(array("level" => $index_counter, "voc_stack" => $stack_id));
                
                $voc_self[] = array();
                
                for($ii = 0; $ii < sizeof($vocabularies_db); $ii++) {
                    $voc = new \Application\Entity\Vocabulary();
                    $voc->setContent($vocabularies_db[$ii]->getContent());
                    $voc_self[] = $voc;
                }
                $holder = new \StudentUI\Entity\VocabularyHolder();
                $holder->setVoc($voc_self);
                unset($voc_self);
                $voc_holder[] = $holder;
            }
                                                                                                                                 
            if ($this->getRequest()->isPost()) {
                $this->changeAction($em, $vocabularies);  
            }
            
            return new ViewModel(array(
                'header' => $vocabularies,
                "voc" => array_filter($voc_holder),
                "stack_id"=> $stack_id,
                "size" =>$vocabularies->getSize()
                )
            );
        } else {
            return $this->getServiceLocator()->get('StudentUIPermissionService')->performNoPermission($this);
        }
    }
    
    public function changeAction($em, $vocabularies) {
        
        $rows = array();

        for($i = 0; $i < $vocabularies->getSize(); $i++) {
            $title = $this->getRequest()->getPost()["title".$i];
            if($title == "") {
                $title = "not set";
            }
            $rows[$i] = $title;

            if($vocabularies->getVocStack()[$i] == null) {
                $newHead = new \Application\Entity\VocabularyHead();
                $newHead->setTitle($rows[$i]);
                $newHead->setVoc_head($vocabularies);
                $em->persist($newHead);
                $em->flush(); 
            } else {
                $oldHead = $vocabularies->getVocStack()[$i];
                $oldHead->setTitle($rows[$i]);
                $em->merge($oldHead);
                $em->flush(); 
            }
        }
        
        
        

    }
}
