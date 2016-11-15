<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('AdminUIPermissionService')->hasRightToAccessAdminUi($this)) {
            $this->layout('layout/layout.phtml');
            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            $user = $em->getRepository('\Application\Entity\User')->findAll(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            return new ViewModel(array(
                'user_array' => $user,
            ));
        } else {
            return $this->getServiceLocator()->get('AdminUIPermissionService')->performNoPermission($this);
        }
    }
}
