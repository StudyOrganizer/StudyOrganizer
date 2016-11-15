<?php
namespace StudentUI\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;


class NewVocabularyController extends AbstractActionController
{

    public function indexAction() {
        if ($this->getServiceLocator()->get('StudentUIPermissionService')->hasRightToAccessStudentUI($this)) {
            $this->layout('layout/studentui.phtml');
            $login = new Container('studentui_login');

            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            $stack_id = $this->getEvent()->getRouteMatch()->getParam('id');
            $stack = $em->getRepository('\Application\Entity\VocabularyStack')->findOneBy(array("id" => $stack_id));


            if ($this->getRequest()->isPost()) {
                $this->addAction($em, $stack->getSize(), $stack);
            }

            return new ViewModel(array(
                "stack" => $stack_id,
                'header' => $stack,
                "count" => $stack->getSize()
            ));
        } else {
            return $this->getServiceLocator()->get('StudentUIPermissionService')->performNoPermission($this);
        }
    }

    public function addAction($em, $size, $stack) {
        $voc_checked = array();
        for($i=1; $i<=$size; $i++) {
            $voc = $this->getRequest()->getPost()["voc".$i];
            if($voc != "") {
                $voc_checked[] = $voc;
            }
        }

        if($size==sizeof($voc_checked)) {
            $voc = $stack->getVoc();
            if(!$voc->last()) {
                $index = 1;
            } else {
                $index = $voc->last()->getLevel()+1;
            }
            for($i=0; $i<sizeof($voc_checked); $i++) {
                $newVoc = new \Application\Entity\Vocabulary();
                $newVoc->setContent($voc_checked[$i]);
                $newVoc->setLevel($index);
                $newVoc->setVoc_stack($stack);
                $em->persist($newVoc);
                $em->flush();
            }
        } else {
            echo "error";
        }
    }

}