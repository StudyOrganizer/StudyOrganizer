<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class EditSchoolController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('AdminUIPermissionService')->hasRightToAccessAdminUi($this)) {
            $this->layout('layout/layout.phtml');
            $id = $this->params('id');
            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            $ex_school = $em->getRepository('\Application\Entity\School')->findOneById($id);

            $users = $em->getRepository('\Application\Entity\User')->findAll(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            $students = array('not_user' => $this->getServiceLocator()->get('translator')->translate('Do not assign a lead student'));
            $teachers = array('not_user' => $this->getServiceLocator()->get('translator')->translate('Do not assign a headmaster'));

            for ($i = 0;$i < sizeof($users);++$i) {
                if (isset($users)) {
                    if ($users[$i]->getStudent() !== null) {
                        $students[$users[$i]->getID()] = $users[$i]->getFirstName().' '.$users[$i]->getLastName();
                    } elseif ($users[$i]->getTeacher() !== null) {
                        $teachers[$users[$i]->getID()] = $users[$i]->getFirstName().' '.$users[$i]->getLastName();
                    }
                }
            }

            if (isset($ex_school)) {
                if ($this->getRequest()->isPost()) {
                    $this->addAction($em, $ex_school);

                    return new ViewModel(array(
                'form' => new \Admin\Form\EditSchoolForm('Placeholder_Holder', $students, $teachers),
              ));
                } else {
                    return new ViewModel(array(
                'form' => new \Admin\Form\EditSchoolForm($ex_school->getName(), $students, $teachers),
              ));
                }
            } else {
                $this->flashMessenger()->setNamespace('error')->addMessage('Error :-( School not found, please provide a valid id');

                return $this->redirect()->toRoute('admin_school_list');
            }
        } else {
            return $this->getServiceLocator()->get('AdminUIPermissionService')->performNoPermission($this);
        }
    }

    public function addAction($em, $school)
    {
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
            $schoolname = $escaper->escapeHtml($name);
          /*
          * check if name is too long (currently 40)
          */
          if (strlen($schoolname) < 40) {
              /*
            * check if school already exists
            */
            $validator = new \DoctrineModule\Validator\NoObjectExists(array(
                // object repository to lookup
                'object_repository' => $em->getRepository('\Application\Entity\School'),

                // fields to match
                'fields' => array('name'),
            ));

              if ($validator->isValid(array('name' => $schoolname))) {
                  $school->setName($schoolname);
                  $em->flush();

                  $this->flashMessenger()->setNamespace('success')->addMessage('Success :-) School edited -> '.$schoolname);
              } else {
                  $this->flashMessenger()->setNamespace('error')->addMessage('Error :-( Schoolname is already used, please provide a valid schoolname.');
              }
          } else {
              $this->flashMessenger()->setNamespace('error')->addMessage('Error :-( Schoolname is too long, please provide a valid schoolname.');
          }
        } else {
            $this->flashMessenger()->setNamespace('error')->addMessage('Error :-( Schoolname is too short, please provide a valid schoolname.');
        }
      } else {
          $this->flashMessenger()->setNamespace('error')->addMessage('Error :-( Schoolname is empty, please provide a valid schoolname.');
      }

        return $this->redirect()->toRoute('admin_school_list');
    }
}
