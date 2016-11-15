<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AddPermissionController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('AdminUIPermissionService')->hasRightToAccessAdminUi($this)) {
            $this->layout('layout/layout.phtml');

            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

            if ($this->getRequest()->isPost()) {
                $this->addAction($em);

                return new ViewModel(array(
              'form' => new \Admin\Form\AddPermissionForm(),
            ));
            } else {
                return new ViewModel(array(
              'form' => new \Admin\Form\AddPermissionForm(),
            ));
            }
        } else {
            return $this->getServiceLocator()->get('AdminUIPermissionService')->performNoPermission($this);
        }
    }

    public function addAction($em)
    {
        //collect date
         $name = $this->getRequest()->getPost()->name;
        isset($this->getRequest()->getPost()->CAN_LOGIN) ? $CAN_LOGIN = $this->getRequest()->getPost()->CAN_LOGIN : $CAN_LOGIN = false;
        isset($this->getRequest()->getPost()->ACCESS_FROM_STUDENT_LEAD) ? $ACCESS_FROM_STUDENT_LEAD = $this->getRequest()->getPost()->ACCESS_FROM_STUDENT_LEAD : $ACCESS_FROM_STUDENT_LEAD = false;
        isset($this->getRequest()->getPost()->ACCESS_FROM_COURS_LEAD) ? $ACCESS_FROM_COURS_LEAD = $this->getRequest()->getPost()->ACCESS_FROM_COURS_LEAD : $ACESS_FROM_COURS_LEAD = false;
        isset($this->getRequest()->getPost()->CAN_ACCESS_ADMIN_AREA) ? $CAN_ACCESS_ADMIN_AREA = $this->getRequest()->getPost()->CAN_ACCESS_ADMIN_AREA : $CAN_ACCESS_ADMIN_AREA = false;
        isset($this->getRequest()->getPost()->CAN_ACCESS_MOD_AREA) ? $CAN_ACCESS_MOD_AREA = $this->getRequest()->getPost()->CAN_ACCESS_MOD_AREA : $CAN_ACCESS_MOD_AREA = false;
        isset($this->getRequest()->getPost()->CAN_ACCESS_TEACHER_AREA) ? $CAN_ACCESS_TEACHER_AREA = $this->getRequest()->getPost()->CAN_ACCESS_TEACHER_AREA : $CAN_ACCESS_TEACHER_AREA = false;
        isset($this->getRequest()->getPost()->CAN_ACCESS_STUDENT_AREA) ? $CAN_ACCESS_STUDENT_AREA = $this->getRequest()->getPost()->CAN_ACCESS_STUDENT_AREA : $CAN_ACCESS_STUDENT_AREA = false;
        isset($this->getRequest()->getPost()->CAN_UPDATE_PROFILE_PRIVATE) ? $CAN_UPDATE_PROFILE_PRIVATE = $this->getRequest()->getPost()->CAN_UPDATE_PROFILE_PRIVATE : $CAN_UPDATE_PROFILE_PRIVATE = false;
        isset($this->getRequest()->getPost()->CAN_UPDATE_PROFILE_INTERNAL) ? $CAN_UPDATE_PROFILE_INTERNAL = $this->getRequest()->getPost()->CAN_UPDATE_PROFILE_INTERNAL : $CAN_UPDATE_PROFILE_INTERNAL = false;
        isset($this->getRequest()->getPost()->CAN_UPDATE_PROFILE_PUBLIC) ? $CAN_UPDATE_PROFILE_PUBLIC = $this->getRequest()->getPost()->CAN_UPDATE_PROFILE_PUBLIC : $CAN_UPDATE_PROFILE_PUBLIC = false;
        isset($this->getRequest()->getPost()->CAN_DELETE_USER_PRIVATE) ? $CAN_DELETE_USER_PRIVATE = $this->getRequest()->getPost()->CAN_DELETE_USER_PRIVATE : $CAN_DELETE_USER_PRIVATE = false;
        isset($this->getRequest()->getPost()->CAN_DELETE_USER_INTERNAL) ? $CAN_DELETE_USER_INTERNAL = $this->getRequest()->getPost()->CAN_DELETE_USER_INTERNAL : $CAN_DELETE_USER_INTERNAL = false;
        isset($this->getRequest()->getPost()->CAN_DELETE_USER_PUBLIC) ? $CAN_DELETE_USER_PUBLIC = $this->getRequest()->getPost()->CAN_DELETE_USER_PUBLIC : $CAN_DELETE_USER_PUBLIC = false;
        isset($this->getRequest()->getPost()->CAN_UPLOAD_DOCUMENT) ? $CAN_UPLOAD_DOCUMENT = $this->getRequest()->getPost()->CAN_UPLOAD_DOCUMENT : $CAN_UPLOAD_DOCUMENT = false;
        isset($this->getRequest()->getPost()->CAN_VIEW_DOCUMENT_PRIVATE) ? $CAN_VIEW_DOCUMENT_PRIVATE = $this->getRequest()->getPost()->CAN_VIEW_DOCUMENT_PRIVATE : $CAN_VIEW_DOCUMENT_PRIVATE = false;
        isset($this->getRequest()->getPost()->CAN_VIEW_DOCUMENT_INTERNAL) ? $CAN_VIEW_DOCUMENT_INTERNAL = $this->getRequest()->getPost()->CAN_VIEW_DOCUMENT_INTERNAL : $CAN_VIEW_DOCUMENT_INTERNAL = false;
        isset($this->getRequest()->getPost()->CAN_VIEW_DOCUMENT_PUBLIC) ? $CAN_VIEW_DOCUMENT_PUBLIC = $this->getRequest()->getPost()->CAN_VIEW_DOCUMENT_PUBLIC : $CAN_VIEW_DOCUMENT_PUBLIC = false;
        isset($this->getRequest()->getPost()->CAN_EDIT_DOCUMENT_PRIVATE) ? $CAN_EDIT_DOCUMENT_PRIVATE = $this->getRequest()->getPost()->CAN_EDIT_DOCUMENT_PRIVATE : $CAN_EDIT_DOCUMENT_PRIVATE = false;
        isset($this->getRequest()->getPost()->CAN_EDIT_DOCUMENT_INTERNAL) ? $CAN_EDIT_DOCUMENT_INTERNAL = $this->getRequest()->getPost()->CAN_EDIT_DOCUMENT_INTERNAL : $CAN_EDIT_DOCUMENT_INTERNAL = false;
        isset($this->getRequest()->getPost()->CAN_EDIT_DOCUMENT_PUBLIC) ? $CAN_EDIT_DOCUMENT_PUBLIC = $this->getRequest()->getPost()->CAN_EDIT_DOCUMENT_PUBLIC : $CAN_EDIT_DOCUMENT_PUBLIC = false;
        isset($this->getRequest()->getPost()->CAN_DELETE_DOCUMENT_PRIVATE) ? $CAN_DELETE_DOCUMENT_PRIVATE = $this->getRequest()->getPost()->CAN_DELETE_DOCUMENT_PRIVATE : $CAN_DELETE_DOCUMENT_PRIVATE = false;
        isset($this->getRequest()->getPost()->CAN_DELETE_DOCUMENT_INTERNAL) ? $CAN_DELETE_DOCUMENT_INTERNAL = $this->getRequest()->getPost()->CAN_DELETE_DOCUMENT_INTERNAL : $CAN_DELETE_DOCUMENT_INTERNAL = false;
        isset($this->getRequest()->getPost()->CAN_DELETE_DOCUMENT_PUBLIC) ? $CAN_DELETE_DOCUMENT_PUBLIC = $this->getRequest()->getPost()->CAN_DELETE_DOCUMENT_PUBLIC : $CAN_DELETE_DOCUMENT_PUBLIC = false;
        isset($this->getRequest()->getPost()->CAN_COMMENT_DOCUMENT_PRIVATE) ? $CAN_COMMENT_DOCUMENT_PRIVATE = $this->getRequest()->getPost()->CAN_COMMENT_DOCUMENT_PRIVATE : $CAN_COMMENT_DOCUMENT_PRIVATE = false;
        isset($this->getRequest()->getPost()->CAN_COMMENT_DOCUMENT_INTERNAL) ? $CAN_COMMENT_DOCUMENT_INTERNAL = $this->getRequest()->getPost()->CAN_COMMENT_DOCUMENT_INTERNAL : $CAN_COMMENT_DOCUMENT_INTERNAL = false;
        isset($this->getRequest()->getPost()->CAN_COMMENT_DOCUMENT_PUBLIC) ? $CAN_COMMENT_DOCUMENT_PUBLIC = $this->getRequest()->getPost()->CAN_COMMENT_DOCUMENT_PUBLIC : $CAN_COMMENT_DOCUMENT_PUBLIC = false;
        isset($this->getRequest()->getPost()->CAN_CREATE_DOCUMENT_PRIVATE) ? $CAN_CREATE_DOCUMENT_PRIVATE = $this->getRequest()->getPost()->CAN_CREATE_DOCUMENT_PRIVATE : $CAN_CREATE_DOCUMENT_PRIVATE = false;
        isset($this->getRequest()->getPost()->CAN_CREATE_DOCUMENT_INTERNAL) ? $CAN_CREATE_DOCUMENT_INTERNAL = $this->getRequest()->getPost()->CAN_CREATE_DOCUMENT_INTERNAL : $CAN_CREATE_DOCUMENT_INTERNAL = false;
        isset($this->getRequest()->getPost()->CAN_CREATE_DOCUMENT_PUBLIC) ? $CAN_CREATE_DOCUMENT_PUBLIC = $this->getRequest()->getPost()->CAN_CREATE_DOCUMENT_PUBLIC : $CAN_CREATE_DOCUMENT_PUBLIC = false;
        isset($this->getRequest()->getPost()->CAN_CREATE_DOCUMENT_TEXT) ? $CAN_CREATE_DOCUMENT_TEXT = $this->getRequest()->getPost()->CAN_CREATE_DOCUMENT_PUBLIC : $CAN_CREATE_DOCUMENT_TEXT = false;
        isset($this->getRequest()->getPost()->CAN_CREATE_DOCUMENT_BWL) ? $CAN_CREATE_DOCUMENT_BWL = $this->getRequest()->getPost()->CAN_CREATE_DOCUMENT_BWL : $CAN_CREATE_DOCUMENT_BWL = false;

        if (strlen($name) > 5) {

          /*
          * excape input
          */
          $escaper = new \Zend\Escaper\Escaper('utf-8');
            $permissionname = $escaper->escapeHtml($name);
              /*
              * check if name is too long (currently 40)
              */
              if (strlen($permissionname) < 40) {
                  /*
                * check if school already exists
                */
                $validator = new \DoctrineModule\Validator\NoObjectExists(array(
                    // object repository to lookup
                    'object_repository' => $em->getRepository('\Application\Entity\Permission'),

                    // fields to match
                    'fields' => array('name'),
                ));

                  if ($validator->isValid(array('name' => $permissionname))) {
                      $permission = new \Application\Entity\Permission();
                      $permission->setName(utf8_encode($name));
                      $permission->setCAN_LOGIN((bool) $CAN_LOGIN);
                      $permission->setACCESS_FROM_COURS_LEAD((bool) $ACCESS_FROM_COURS_LEAD);
                      $permission->setACCESS_FROM_STUDENT_LEAD((bool) $ACCESS_FROM_STUDENT_LEAD);
                      $permission->setCAN_ACCESS_ADMIN_AREA((bool) $CAN_ACCESS_ADMIN_AREA);
                      $permission->setCAN_ACCESS_MOD_AREA((bool) $CAN_ACCESS_MOD_AREA);
                      $permission->setCAN_ACCESS_TEACHER_AREA((bool) $CAN_ACCESS_TEACHER_AREA);
                      $permission->setCAN_ACCESS_STUDENT_AREA((bool) $CAN_ACCESS_STUDENT_AREA);
                      $permission->setCAN_UPDATE_PROFILE_PRIVATE((bool) $CAN_UPDATE_PROFILE_PRIVATE);
                      $permission->setCAN_UPDATE_PROFILE_INTERNAL((bool) $CAN_UPDATE_PROFILE_INTERNAL);
                      $permission->setCAN_UPDATE_PROFILE_PUBLIC((bool) $CAN_UPDATE_PROFILE_PUBLIC);
                      $permission->setCAN_DELETE_USER_PRIVATE((bool) $CAN_DELETE_USER_PRIVATE);
                      $permission->setCAN_DELETE_USER_INTERNAL((bool) $CAN_DELETE_USER_INTERNAL);
                      $permission->setCAN_DELETE_USER_PUBLIC((bool) $CAN_DELETE_USER_PUBLIC);
                      $permission->setCAN_UPLOAD_DOCUMENT((bool) $CAN_UPLOAD_DOCUMENT);
                      $permission->setCAN_VIEW_DOCUMENT_PRIVATE((bool) $CAN_VIEW_DOCUMENT_PRIVATE);
                      $permission->setCAN_VIEW_DOCUMENT_INTERNAL((bool) $CAN_VIEW_DOCUMENT_INTERNAL);
                      $permission->setCAN_VIEW_DOCUMENT_PUBLIC((bool) $CAN_VIEW_DOCUMENT_PUBLIC);
                      $permission->setCAN_EDIT_DOCUMENT_PRIVATE((bool) $CAN_EDIT_DOCUMENT_PRIVATE);
                      $permission->setCAN_EDIT_DOCUMENT_INTERNAL((bool) $CAN_EDIT_DOCUMENT_INTERNAL);
                      $permission->setCAN_EDIT_DOCUMENT_PUBLIC((bool) $CAN_EDIT_DOCUMENT_PUBLIC);
                      $permission->setCAN_DELETE_DOCUMENT_PRIVATE((bool) $CAN_DELETE_DOCUMENT_PRIVATE);
                      $permission->setCAN_DELETE_DOCUMENT_INTERNAL((bool) $CAN_DELETE_DOCUMENT_INTERNAL);
                      $permission->setCAN_DELETE_DOCUMENT_PUBLIC((bool) $CAN_DELETE_DOCUMENT_PUBLIC);
                      $permission->setCAN_COMMENT_DOCUMENT_PRIVATE((bool) $CAN_COMMENT_DOCUMENT_PRIVATE);
                      $permission->setCAN_COMMENT_DOCUMENT_INTERNAL((bool) $CAN_COMMENT_DOCUMENT_INTERNAL);
                      $permission->setCAN_COMMENT_DOCUMENT_PUBLIC((bool) $CAN_COMMENT_DOCUMENT_PUBLIC);
                      $permission->setCAN_CREATE_DOCUMENT_PRIVATE((bool) $CAN_CREATE_DOCUMENT_PRIVATE);
                      $permission->setCAN_CREATE_DOCUMENT_INTERNAL((bool) $CAN_CREATE_DOCUMENT_INTERNAL);
                      $permission->setCAN_CREATE_DOCUMENT_PUBLIC((bool) $CAN_CREATE_DOCUMENT_PUBLIC);
                      $permission->setCAN_CREATE_DOCUMENT_TEXT((bool) $CAN_CREATE_DOCUMENT_TEXT);
                      $permission->setCAN_CREATE_DOCUMENT_BWL((bool) $CAN_CREATE_DOCUMENT_BWL);
                      $em->persist($permission);
                      $em->flush();

                      $this->flashMessenger()->setNamespace('success')->addMessage('Success :-) Permission added -> '.$permissionname);

                      return $this->redirect()->toRoute('admin_permissions_list');
                  } else {
                      $this->flashMessenger()->setNamespace('error')->addMessage('Error :-( Permissionname is already used, please provide a valid name.');
                  }
              } else {
                  $this->flashMessenger()->setNamespace('error')->addMessage('Error :-( Permissionname is too long, please provide a valid name.');
              }
        } else {
            $this->flashMessenger()->setNamespace('error')->addMessage('Error :-( Permissionname is too short, please provide a valid name.');
        }

        return $this->redirect()->toRoute('admin_permissions_list');
    }
}
