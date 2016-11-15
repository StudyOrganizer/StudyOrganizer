<?php

namespace StudentUI\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class VocabularyStackController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('StudentUIPermissionService')->hasRightToAccessStudentUI($this)) {
            $this->layout('layout/studentui.phtml');
            $login = new Container('studentui_login');

            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            $vocabulary = $em->getRepository('\Application\Entity\VocabularyStack')->findAll(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            
            
            if (!isset($login->UserID)) {
                return $this->redirect('login');
                die();
            }

            return new ViewModel(array(
                'vocabulary' => $vocabulary,
                )
            );
        } else {
            return $this->getServiceLocator()->get('StudentUIPermissionService')->performNoPermission($this);
        }
    }
}
