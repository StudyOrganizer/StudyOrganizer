<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AddSubjectController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('AdminUIPermissionService')->hasRightToAccessAdminUi($this)) {
            $this->layout('layout/layout.phtml');
            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

            $icon_array = array('fa fa-language' => 'Language Icon',
                                'fa fa-line-chart' => 'VWL Icon',
                                'fa fa-eur' => 'BWL Icon',
                                'fa fa-picture-o' => 'Art Icon',
                                'fa fa-calculator' => "Maths Icon",
                                'fa fa-book' => 'Book Icon',
                                'fa fa-code' => 'Informatic',
                                'fa fa-flask' => "Chemie",
                                'fa fa-futbol-o' => "Sport Icon",
                                'fa fa-heartbeat' => "Health Icon",
                                "fa fa-leaf" => "Biology",
                                "fa fa-university" => "History Icon",
                                "fa fa-laptop" => "IV",
                                "fa fa-user-md" => "Psycho",
                                "fa fa-users" => "Pädagogik");

            $schools = $em->getRepository('\Application\Entity\School')->findAll(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            //check if school is already added
            if (!isset($schools['0'])) {
                $this->flashMessenger()->setNamespace('error')->addMessage('Error :-( First you have to add a school.');
                return $this->redirect()->toRoute('add_school');
            }

            //Schools
            for ($i = 0;$i < sizeof($schools);++$i) {
                $school_array[$schools[$i]->getID()] = $schools[$i]->getName();
            }

            if ($this->getRequest()->isPost()) {
                $this->addAction($em);

                return new ViewModel(array(
                    'form' => new \Admin\Form\AddSubjectForm($icon_array, $school_array),
                ));
            } else {
                return new ViewModel(array(
                    'form' => new \Admin\Form\AddSubjectForm($icon_array, $school_array),
                ));
            }
        } else {
            return $this->getServiceLocator()->get('AdminUIPermissionService')->performNoPermission($this);
        }
    }

    public function addAction($em)
    {
        $name = $this->getRequest()->getPost()->name;
        $icon = $this->getRequest()->getPost()->select;
        $select_school = $this->getRequest()->getPost()->select_school;

        if ($icon != '' && $name != '' && $select_school != "") {
            $newSubject = new \Application\Entity\Subject();
            $school_fetched = $em->getRepository('\Application\Entity\School')->findOneById($select_school);

            $newSubject->setName(utf8_decode($name));
            $newSubject->setIcon($icon);
            $newSubject->setSchool($school_fetched);
            $em->persist($newSubject);
            $em->flush();
            $this->flashMessenger()->setNamespace('success')->addMessage('Complete');

            return $this->redirect()->toRoute('admin_subjects_list');
        } else {
            $this->flashMessenger()->setNamespace('error')->addMessage('Error :-( Please supply everything');
        }

        return $this->redirect()->toRoute('add_subject');
    }
}
