<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AddSchoolTimeController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('AdminUIPermissionService')->hasRightToAccessAdminUi($this)) {
            $this->layout('layout/layout.phtml');
            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

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
                    'form' => new \Admin\Form\AddSchoolTimeForm($school_array),
                ));
            } else {
                return new ViewModel(array(
                    'form' => new \Admin\Form\AddSchoolTimeForm($school_array),
                ));
            }
        } else {
            return $this->getServiceLocator()->get('AdminUIPermissionService')->performNoPermission($this);
        }
    }

    public function addAction($em)
    {
        $name = $this->getRequest()->getPost()->name;
        $end = $this->getRequest()->getPost()->end;
        $start = $this->getRequest()->getPost()->start;
        $select_school = $this->getRequest()->getPost()->select;

        if ($name != '' && $end != '' && $start != '' && $select_school != '') {
            $school_fetched = $em->getRepository('\Application\Entity\School')->findOneById($select_school);

            $day_array = array("0" => "monday",
                "1" => "tuesday",
                "2" => "wednesday",
                "3" => "thursday",
                "4" => "friday",
                "5" => "saturday");

            for($i = 0; $i < sizeof($day_array); $i++) {
                $newSchoolTime = new \Application\Entity\SubjectTime();
                $newSchoolTime->setName($name);
                $newSchoolTime->setSchool($school_fetched);
                $newSchoolTime->setStart(new \DateTime($start));
                $newSchoolTime->setEnd(new \DateTime($end));
                $newSchoolTime->setDay($day_array[$i]);
                $em->persist($newSchoolTime);
                $em->flush();
            }

            $this->flashMessenger()->setNamespace('success')->addMessage('Complete');

            return $this->redirect('add_school_time');
        } else {
            $this->flashMessenger()->setNamespace('error')->addMessage('Error :-( Please supply everything');
        }

        return $this->redirect->toRoute('add_school_time');
    }
}
