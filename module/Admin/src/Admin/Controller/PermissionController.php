<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PermissionController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('AdminUIPermissionService')->hasRightToAccessAdminUi($this)) {
            $this->layout('layout/layout.phtml');
            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            $permissions = $em->getRepository('\Application\Entity\Permission')->findAll(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            return new ViewModel(array(
              'permissions_array' => $permissions,
            ));
        } else {
            return $this->getServiceLocator()->get('AdminUIPermissionService')->performNoPermission($this);
        }
    }
}
