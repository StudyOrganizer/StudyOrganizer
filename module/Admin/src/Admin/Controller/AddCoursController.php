<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AddCoursController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('AdminUIPermissionService')->hasRightToAccessAdminUi($this)) {
            $this->layout('layout/layout.phtml');
            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

            //fetch from database
            $schools = $em->getRepository('\Application\Entity\School')->findAll(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            $courses_groups = $em->getRepository('\Application\Entity\CoursGroup')->findAll(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            //ToDo
            $subject = $em->getRepository('\Application\Entity\Subject')->findAll(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            //check if school is already added
            if (!isset($schools['0'])) {
                $this->flashMessenger()->setNamespace('error')->addMessage('Error :-( First you have to add a school.');
                return $this->redirect()->toRoute('add_school');
            }

            //check if cours is already added
            if (!isset($courses_groups['0'])) {
                $this->flashMessenger()->setNamespace('error')->addMessage('Error :-( First you have to add a cours group.');
                return $this->redirect()->toRoute('add_cours_group');
            }

            if (!isset($subject['0'])) {
                $this->flashMessenger()->setNamespace('error')->addMessage('Error :-( First you have to add a subject.');
                return $this->redirect()->toRoute('add_subject');
            }

            //declare arrays
            $school_array = array();
            $courses_group_array = array();
            $subject_array = array();

            //Schools
            for ($i = 0;$i < sizeof($schools);++$i) {
                $school_array[$schools[$i]->getID()] = $schools[$i]->getName();
            }

            //CoursesGroups
            for ($i = 0;$i < sizeof($courses_groups);++$i) {
                $courses_group_array[$courses_groups[$i]->getID()] = $courses_groups[$i]->getName();
            }

            //Subjects
            for ($i = 0;$i < sizeof($subject);++$i) {
                $subject_array[$subject[$i]->getID()] = $subject[$i]->getName();
            }

            if ($this->getRequest()->isPost()) {
                $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
                $this->addAction($em);

                return new ViewModel(array(
              'form' => new \Admin\Form\AddCoursForm($school_array, $courses_group_array, $subject_array),
            ));
            } else {
                return new ViewModel(array(
              'form' => new \Admin\Form\AddCoursForm($school_array, $courses_group_array, $subject_array),
            ));
            }
        } else {
            return $this->getServiceLocator()->get('AdminUIPermissionService')->performNoPermission($this);
        }
    }

    public function addAction($em)
    {
        $name = $this->getRequest()->getPost()->name;
        $school_id = $this->getRequest()->getPost()->select;
        $cours_groups_id = $this->getRequest()->getPost()->select_courses;
        $subjects_id = $this->getRequest()->getPost()->select_subjects;

          /*
          * check if name, school_id, cours_group_id is empty
          */
          if ($name != '' && $school_id != '' && $cours_groups_id != null && $subjects_id != null) {
              /*
            * check if name is too short (currently 2)
            */
            if (strlen($name) > 2) {
                /*
              * excape input
              */
              $escaper = new \Zend\Escaper\Escaper('utf-8');
              $coursesname = $escaper->escapeHtml($name);

              /*
              * check if name is too long (currently 40)
              */
              if (strlen($coursesname) < 40) {
                  /*
                * check if cours already exists
                */
                $validator = new \DoctrineModule\Validator\NoObjectExists(array(
                    // object repository to lookup
                    'object_repository' => $em->getRepository('\Application\Entity\Cours'),

                    // fields to match
                    'fields' => array('name'),
                ));

                  if ($validator->isValid(array('name' => $coursesname))) {
                      $school_fetched = $em->getRepository('\Application\Entity\School')->findOneById($school_id);

                      $newCours = new \Application\Entity\Cours();
                      $newCours->setName($coursesname);
                      $newCours->setSchool($school_fetched);

                      for($f = 0; sizeof($cours_groups_id) > $f;$f++) {
                          $newCours->addGroup($em->getRepository('\Application\Entity\CoursGroup')->findOneById($cours_groups_id[$f]));
                      }

                      for($s = 0; sizeof($subjects_id) > $s;$s++) {
                          $newCours->addSubject($em->getRepository('\Application\Entity\Subject')->findOneById($subjects_id[$s]));
                      }

                      $em->persist($newCours);
                      $em->flush();

                      $this->flashMessenger()->setNamespace('success')->addMessage('Success :-) cours added -> '.$coursesname);
                  } else {
                      $this->flashMessenger()->setNamespace('error')->addMessage('Error :-( coursname is already used, please provide a valid coursname.');
                  }
              } else {
                  $this->flashMessenger()->setNamespace('error')->addMessage('Error :-( coursname is too long, please provide a valid coursname.');
              }
            } else {
                $this->flashMessenger()->setNamespace('error')->addMessage('Error :-( coursname is too short, please provide a valid coursname.');
            }
          } else {
              $this->flashMessenger()->setNamespace('error')->addMessage('Error :-( coursname is empty, please provide a valid coursname.');
          }

           return $this->redirect()->toRoute('admin_courses_list');
        }
}
