<?php
namespace ajax\V1\Rpc\Subjects;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use ZF\ContentNegotiation\ViewModel;


class SubjectsController extends AbstractActionController
{
    public function subjectsAction()
    {
        $login = new Container("studentui_login");
        if(isset($login->UserID)) {
            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            $user = $em->getRepository('\Application\Entity\User')->findOneById($login->UserID);

            $date = $this->getRequest()->getPost()->date;
            $dt_obj = new \DateTime($date);

            $monday = array();
            $tuesday = array();
            $wednesday = array();
            $thursday = array();
            $friday = array();
            $saturday = array();

            $dw = date("w", $dt_obj->getTimestamp());
            $timetable = $user->getTimetable();
            if($timetable != NULL) {
                for($i = 0; $i < sizeof($timetable->getTimeHolder()); $i++) {
                    if($timetable->getTimeHolder()->get($i)->getTimes()->getDay() == "monday") {
                        $monday[$i] = array("name" => utf8_encode($timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getSubject()->getName()), "subject_holder_id" => $timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getID());
                    } elseif($timetable->getTimeHolder()->get($i)->getTimes()->getDay() == "tuesday") {
                        $tuesday[$i] = array("name" => utf8_encode($timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getSubject()->getName()), "subject_holder_id" => $timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getID());
                    } elseif($timetable->getTimeHolder()->get($i)->getTimes()->getDay() == "wednesday") {
                        $wednesday[$i] = array("name" => utf8_encode($timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getSubject()->getName()), "subject_holder_id" => $timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getID());
                    } elseif($timetable->getTimeHolder()->get($i)->getTimes()->getDay() == "thursday") {
                        $thursday[$i] = array("name" => utf8_encode($timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getSubject()->getName()), "subject_holder_id" => $timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getID());
                    } elseif($timetable->getTimeHolder()->get($i)->getTimes()->getDay() == "friday") {
                        $friday[$i] = array("name" => utf8_encode($timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getSubject()->getName()), "subject_holder_id" => $timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getID());
                    } elseif($timetable->getTimeHolder()->get($i)->getTimes()->getDay() == "saturday") {
                        $saturday[$i] = array("name" => utf8_encode($timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getSubject()->getName()), "subject_holder_id" => $timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getID());
                    }
                }
            }

            switch ($dw) {
                case 0:
                    $day = "sunday";
                    $subjects = array();
                    break;
                case 1:
                    $day = "monday";
                    $subjects = array_values($monday);
                    break;
                case 2:
                    $day = "tuesday";
                    $subjects = array_values($tuesday);
                    break;
                case 3:
                    $day = "wednesday";
                    $subjects = array_values($wednesday);
                    break;
                case 4:
                    $day = "thursday";
                    $subjects = array_values($thursday);
                    break;
                case 5:
                    $day = "friday";
                    $subjects = array_values($friday);
                    break;
                case 6:
                    $day = "saturday";
                    $subjects = array_values($saturday);
            }

            return new ViewModel(array(
                "message" => "ok",
                "day" => $day,
                "subjects" => $subjects
            ));
        } else {
           return new ApiProblemResponse(new ApiProblem(401, "Unauthorized"));
        }    
    }
}
