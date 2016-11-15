<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AddCoursGroupController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('AdminUIPermissionService')->hasRightToAccessAdminUi($this)) {
            $this->layout('layout/layout.phtml');
            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            $users = $em->getRepository('\Application\Entity\User')->findAll(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            $user_option_array = array('not_user' => $this->getServiceLocator()->get('translator')->translate('Do not assign a lead student'));

            for ($i = 0;$i < sizeof($users);++$i) {
                if (isset($users)) {
                    if ($users[$i]->getStudent() !== null) {
                        $user_option_array[$users[$i]->getID()] = $users[$i]->getFirstName().' '.$users[$i]->getLastName();
                    }
                }
            }

            if ($this->getRequest()->isPost()) {
                $this->addAction($em);

                return new ViewModel(array(
              'form' => new \Admin\Form\AddCoursGroupForm($user_option_array),
            ));
            } else {
                return new ViewModel(array(
              'form' => new \Admin\Form\AddCoursGroupForm($user_option_array),
            ));
            }
        } else {
            return $this->getServiceLocator()->get('AdminUIPermissionService')->performNoPermission($this);
        }
    }

    public function addAction($em)
    {
        //collect parameter
      $name = $this->getRequest()->getPost()->name;

      /*
      * check if name is empty
      */
      if ($name != '') {
          /*
        * check if name is too short (currently 5)
        */
        if (strlen($name) > 5) {
            /*
          * excape input
          */
          $escaper = new \Zend\Escaper\Escaper('utf-8');
            $coursgroupname = $escaper->escapeHtml($name);
          /*
          * check if name is too long (currently 40)
          */
          if (strlen($coursgroupname) < 40) {
              /*
            * check if school already exists
            */
            $validator = new \DoctrineModule\Validator\NoObjectExists(array(
                // object repository to lookup
                'object_repository' => $em->getRepository('\Application\Entity\CoursGroup'),

                // fields to match
                'fields' => array('name'),
            ));

              if ($validator->isValid(array('name' => $coursgroupname))) {
                  $newCoursGroupName = new \Application\Entity\CoursGroup();
                  $newCoursGroupName->setName($coursgroupname);
                  $em->persist($newCoursGroupName);
                  $em->flush();

                  $this->flashMessenger()->setNamespace('success')->addMessage('Success :-) cours group added -> '.$coursgroupname);
              } else {
                  $this->flashMessenger()->setNamespace('error')->addMessage('Error :-( cours group name is already used, please provide a valid cours group name.');
              }
          } else {
              $this->flashMessenger()->setNamespace('error')->addMessage('Error :-( cours group name is too long, please provide a valid cours group name.');
          }
        } else {
            $this->flashMessenger()->setNamespace('error')->addMessage('Error :-( cours group name is too short, please provide a valid cours group name.');
        }
      } else {
          $this->flashMessenger()->setNamespace('error')->addMessage('Error :-( cours group name is empty, please provide a valid cours group name.');
      }

        return $this->redirect()->toRoute('admin_courses_group_list');
    }
}
