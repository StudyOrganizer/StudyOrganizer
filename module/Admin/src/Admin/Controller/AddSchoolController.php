<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AddSchoolController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('AdminUIPermissionService')->hasRightToAccessAdminUi($this)) {
            $this->layout('layout/layout.phtml');
            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

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

            if ($this->getRequest()->isPost()) {
                $this->addAction($em);

                return new ViewModel(array(
                  'form' => new \Admin\Form\AddSchoolForm($students, $teachers),
                ));
            } else {
                return new ViewModel(array(
              'form' => new \Admin\Form\AddSchoolForm($students, $teachers),
            ));
            }
        } else {
            return $this->getServiceLocator()->get('AdminUIPermissionService')->performNoPermission($this);
        }
    }

    public function addAction($em)
    {
    //collect paramter
    $name = $this->getRequest()->getPost()->name;
    $student_id = $this->getRequest()->getPost()->select_student_lead;
    $teacher_id = $this->getRequest()->getPost()->select_headmaster;

    /*
    * check if name is empty
    */
    if ($name != '' && $teacher_id != '' && $student_id != '') {
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
                  $newSchool = new \Application\Entity\School();
                  $newSchool->setName($schoolname);
                  $em->persist($newSchool);
                  $em->flush();

                  $this->flashMessenger()->setNamespace('success')->addMessage('Success :-) School added -> '.$schoolname);
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
