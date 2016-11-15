<?php
namespace StudentUI\Controller;

use Application\Entity\TimeTable;
use Application\Entity\TimeTableSubjectHolder;
use Application\Entity\TimeTableTimeHolder;
use DoctrineModule\Validator\NoObjectExists;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class AddTimeTableController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('StudentUIPermissionService')->hasRightToAccessStudentUI($this)) {
            $this->layout('layout/studentui.phtml');
            $login = new Container('studentui_login');

            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

            if (!isset($login->UserID)) {
                return $this->redirect('login');
                die();
            }

            $user = $em->getRepository('\Application\Entity\User')->findOneById($login->UserID);
            $times = $em->getRepository('\Application\Entity\SubjectTime')->findBy(array("day" => "monday", "school" => $user->getStudent()->getSchool()->getID()));

            if ($this->getRequest()->isPost()) {
                $this->addTimetable($em, $times, $user);
            }

            return new ViewModel(array(
                "times" => $times,
                'subjects' => $user->getStudent()->getSchool()->getSubjects()
            ));
        } else {
            return $this->getServiceLocator()->get('StudentUIPermissionService')->performNoPermission($this);
        }
    }

    public function addTimetable($em, $times, $user) {
        $monday = array();
        $tuesday = array();
        $wednesday = array();
        $thursday = array();
        $friday = array();
        $saturday = array();
        $name = $this->getRequest()->getPost()["name"];

        for($i = 0; $i < sizeof($times); $i++) {
            $id = $times[$i]->getID();
            $monday[$i] = $this->getRequest()->getPost()["monday".$id];
            $tuesday[$i] = $this->getRequest()->getPost()["tuesday".$id];
            $wednesday[$i] = $this->getRequest()->getPost()["wednesday".$id];
            $thursday[$i] = $this->getRequest()->getPost()["thursday".$id];
            $friday[$i] = $this->getRequest()->getPost()["friday".$id];
            $saturday[$i] = $this->getRequest()->getPost()["saturday".$id];
        }

        if($name != "") {
            //add to database
            $timetable = new TimeTable();
            $timetable->setName($name);
            $timetable->setUptopdate(true);
            $em->persist($timetable);
            $em->flush($timetable);
            $user->setTimetable($timetable);


            //monday
            for($i = 0; $i < sizeof($monday); $i++) {
                $time = $em->getRepository('\Application\Entity\SubjectTime')->findBy(array("day" => "monday", "school" => $user->getStudent()->getSchool()->getID(), "name" => $times[$i]->getName()))[0];
                $subject = $em->getRepository('\Application\Entity\Subject')->findOneById($monday[$i]);

                $time_holder = new TimeTableTimeHolder();
                $time_holder->setTimes($time);
                $em->persist($time_holder);
                $em->flush();

                $subject_holder = new TimeTableSubjectHolder();
                $cours = $this->getRelatedCours($em, $user, $subject);
                if(!empty($cours)) {
                    $subject_holder->setCours($cours);
                }
                $subject_holder->setSubject($subject);
                $em->persist($subject_holder);
                $em->flush();

                $time_holder->addTimeSubjectHolder($subject_holder);
                $em->persist($time_holder);
                $em->flush();

                $timetable->addTimeHolder($time_holder);
                $em->persist($timetable);
                $em->flush();
            }

            //tuesday
            for($i = 0; $i < sizeof($tuesday); $i++) {
                $time = $em->getRepository('\Application\Entity\SubjectTime')->findBy(array("day" => "tuesday", "school" => $user->getStudent()->getSchool()->getID(), "name" => $times[$i]->getName()))[0];
                $subject = $em->getRepository('\Application\Entity\Subject')->findOneById($tuesday[$i]);

                $time_holder = new TimeTableTimeHolder();
                $time_holder->setTimes($time);
                $em->persist($time_holder);
                $em->flush();

                $subject_holder = new TimeTableSubjectHolder();
                $cours = $this->getRelatedCours($em, $user, $subject);
                if(!empty($cours)) {
                    $subject_holder->setCours($cours);
                }
                $subject_holder->setSubject($subject);
                $em->persist($subject_holder);
                $em->flush();

                $time_holder->addTimeSubjectHolder($subject_holder);
                $em->persist($time_holder);
                $em->flush();

                $timetable->addTimeHolder($time_holder);
                $em->persist($timetable);
                $em->flush();
            }

            //wednesday
            for($i = 0; $i < sizeof($wednesday); $i++) {
                $time = $em->getRepository('\Application\Entity\SubjectTime')->findBy(array("day" => "wednesday", "school" => $user->getStudent()->getSchool()->getID(), "name" => $times[$i]->getName()))[0];
                $subject = $em->getRepository('\Application\Entity\Subject')->findOneById($wednesday[$i]);

                $time_holder = new TimeTableTimeHolder();
                $time_holder->setTimes($time);
                $em->persist($time_holder);
                $em->flush();

                $subject_holder = new TimeTableSubjectHolder();
                $cours = $this->getRelatedCours($em, $user, $subject);
                if(!empty($cours)) {
                    $subject_holder->setCours($cours);
                }
                $subject_holder->setSubject($subject);
                $em->persist($subject_holder);
                $em->flush();

                $time_holder->addTimeSubjectHolder($subject_holder);
                $em->persist($time_holder);
                $em->flush();

                $timetable->addTimeHolder($time_holder);
                $em->persist($timetable);
                $em->flush();
            }


            //thursday
            for($i = 0; $i < sizeof($thursday); $i++) {
                $time = $em->getRepository('\Application\Entity\SubjectTime')->findBy(array("day" => "thursday", "school" => $user->getStudent()->getSchool()->getID(), "name" => $times[$i]->getName()))[0];
                $subject = $em->getRepository('\Application\Entity\Subject')->findOneById($thursday[$i]);

                $time_holder = new TimeTableTimeHolder();
                $time_holder->setTimes($time);
                $em->persist($time_holder);
                $em->flush();

                $subject_holder = new TimeTableSubjectHolder();
                $cours = $this->getRelatedCours($em, $user, $subject);
                if(!empty($cours)) {
                    $subject_holder->setCours($cours);
                }
                $subject_holder->setSubject($subject);
                $em->persist($subject_holder);
                $em->flush();

                $time_holder->addTimeSubjectHolder($subject_holder);
                $em->persist($time_holder);
                $em->flush();

                $timetable->addTimeHolder($time_holder);
                $em->persist($timetable);
                $em->flush();
            }

            //friday
            for($i = 0; $i < sizeof($friday); $i++) {
                $time = $em->getRepository('\Application\Entity\SubjectTime')->findBy(array("day" => "friday", "school" => $user->getStudent()->getSchool()->getID(), "name" => $times[$i]->getName()))[0];
                $subject = $em->getRepository('\Application\Entity\Subject')->findOneById($friday[$i]);

                $time_holder = new TimeTableTimeHolder();
                $time_holder->setTimes($time);
                $em->persist($time_holder);
                $em->flush();

                $subject_holder = new TimeTableSubjectHolder();
                $cours = $this->getRelatedCours($em, $user, $subject);
                if(!empty($cours)) {
                    $subject_holder->setCours($cours);
                }
                $subject_holder->setSubject($subject);
                $em->persist($subject_holder);
                $em->flush();

                $time_holder->addTimeSubjectHolder($subject_holder);
                $em->persist($time_holder);
                $em->flush();

                $timetable->addTimeHolder($time_holder);
                $em->persist($timetable);
                $em->flush();
            }

            //saturday
            for($i = 0; $i < sizeof($saturday); $i++) {
                $time = $em->getRepository('\Application\Entity\SubjectTime')->findBy(array("day" => "saturday", "school" => $user->getStudent()->getSchool()->getID(), "name" => $times[$i]->getName()))[0];
                $subject = $em->getRepository('\Application\Entity\Subject')->findOneById($saturday[$i]);

                $time_holder = new TimeTableTimeHolder();
                $time_holder->setTimes($time);
                $em->persist($time_holder);
                $em->flush();

                $subject_holder = new TimeTableSubjectHolder();
                $cours = $this->getRelatedCours($em, $user, $subject);
                if(!empty($cours)) {
                    $subject_holder->setCours($cours);
                }
                $subject_holder->setSubject($subject);
                $em->persist($subject_holder);
                $em->flush();

                $time_holder->addTimeSubjectHolder($subject_holder);
                $em->persist($time_holder);
                $em->flush();

                $timetable->addTimeHolder($time_holder);
                $em->persist($timetable);
                $em->flush();
            }


            $this->flashMessenger()->setNamespace('success')->addMessage("Success");
        } else {
            $this->flashMessenger()->setNamespace('error')->addMessage("The name is not valid :(");
        }

        return $this->redirect()->toRoute('studentui_calendar');
    }

    /**
     * @param $em
     * @param $user
     * @param $subject
     * @return array
     */
    public function getRelatedCours($em, $user, $subject)
    {
        $user_courses = $user->getStudent()->getCoursesMember();
        $user_array = array();
        $subject_courses = $subject->getCourses();
        $subject_array = array();

        for ($i = 0; $i < sizeof($user_courses); $i++) {
            $user_array[] = $user_courses[$i]->getId();
        }

        for ($i = 0; $i < sizeof($subject_courses); $i++) {
            $subject_array[] = $subject_courses[$i]->getId();
        }

        $cours_array = array();

        if (sizeof($user_array) > sizeof($subject_array)) {
            for ($i = 0; $i < sizeof($user_array); $i++) {

                if (in_array($user_array[$i], $subject_array)) {
                    $cours_array[] = $user_array[$i];
                }
            }
        } else {
            for ($i = 0; $i < sizeof($subject_array); $i++) {
                if (in_array($subject_array[$i], $user_array)) {
                    $cours_array[] = $subject_array[$i];
                }
            }
        }
        if (!empty($cours_array)) {
            $cours = $em->getRepository('\Application\Entity\Cours')->findOneById($cours_array[0]);
            return $cours;
        } else {
            return array();
        }
    }
}
