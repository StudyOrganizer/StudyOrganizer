<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CoursGroupController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('AdminUIPermissionService')->hasRightToAccessAdminUi($this)) {
            $this->layout('layout/layout.phtml');
            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            $courses_group = $em->getRepository('\Application\Entity\CoursGroup')->findAll(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            return new ViewModel(array(
              'courses_array' => $courses_group,
            ));
        } else {
            return $this->getServiceLocator()->get('AdminUIPermissionService')->performNoPermission($this);
        }
    }
}
