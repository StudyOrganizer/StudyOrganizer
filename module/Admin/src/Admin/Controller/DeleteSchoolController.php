<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class DeleteSchoolController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('AdminUIPermissionService')->hasRightToAccessAdminUi($this)) {
            $slug = $this->params('id');
            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            $ex_school = $em->getRepository('\Application\Entity\School')->findOneById($slug);
            if (isset($ex_school)) {
                $schoolname = $ex_school->getName();
                $em->remove($ex_school);
                $em->flush();
                $this->flashMessenger()->setNamespace('success')->addMessage('Success :-) School deleted -> '.$schoolname);

                return $this->redirect()->toRoute('admin_school_list');
            } else {
                $this->flashMessenger()->setNamespace('error')->addMessage('Error :-( School not found, please provide a valid id');

                return $this->redirect()->toRoute('admin_school_list');
            }
        } else {
            return $this->getServiceLocator()->get('AdminUIPermissionService')->performNoPermission($this);
        }
    }
}
