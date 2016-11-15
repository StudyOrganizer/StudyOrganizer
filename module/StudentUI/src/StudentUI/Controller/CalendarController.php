<?php
namespace StudentUI\Controller;

use StudentUI\Entity\HomeworkList;
use StudentUI\Entity\TestList;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Doctrine\Common\Collections\ArrayCollection;

class CalendarController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('StudentUIPermissionService')->hasRightToAccessStudentUI($this)) {
            $this->layout('layout/studentui.phtml');
            $login = new Container('studentui_login');

            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

            $user = $em->getRepository('\Application\Entity\User')->findOneById($login->UserID);
            $times = $em->getRepository('\Application\Entity\SubjectTime')->findBy(array("day" => "monday", "school" => $user->getStudent()->getSchool()->getID()));
            $timetable = $user->getTimetable();

            if (!isset($login->UserID)) {
                return $this->redirect('login');
                die();
            }

            $monday_array = array();
            $tuesday_array = array();
            $wednesday = array();
            $thursday = array();
            $friday = array();
            $saturday = array();

            $subject_holder_array = array();
            $subject_names = array();

            if($timetable != NULL) {
                for($i = 0; $i < sizeof($timetable->getTimeHolder()); $i++) {
                    if($timetable->getTimeHolder()->get($i)->getTimes()->getDay() == "monday") {
                        $monday_array[$i] = $timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getSubject()->getName();

                        if($timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getCours() != null) {
                            if(!in_array($timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getSubject()->getName(), $subject_names)) {
                                $subject_names[] = $timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getSubject()->getName();
                                $subject_holder_array[] = $timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0);
                            };
                        }
                    } elseif($timetable->getTimeHolder()->get($i)->getTimes()->getDay() == "tuesday") {
                        $tuesday_array[$i] = $timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getSubject()->getName();

                        if($timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getCours() != null) {
                            if(!in_array($timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getSubject()->getName(), $subject_names)) {
                                $subject_names[] = $timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getSubject()->getName();
                                $subject_holder_array[] = $timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0);
                            };
                        }
                    } elseif($timetable->getTimeHolder()->get($i)->getTimes()->getDay() == "wednesday") {
                        $wednesday[$i] = $timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getSubject()->getName();

                        if($timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getCours() != null) {
                            if(!in_array($timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getSubject()->getName(), $subject_names)) {
                                $subject_names[] = $timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getSubject()->getName();
                                $subject_holder_array[] = $timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0);
                            };
                        }
                    } elseif($timetable->getTimeHolder()->get($i)->getTimes()->getDay() == "thursday") {
                        $thursday[$i] = $timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getSubject()->getName();

                        if($timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getCours() != null) {
                            if(!in_array($timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getSubject()->getName(), $subject_names)) {
                                $subject_names[] = $timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getSubject()->getName();
                                $subject_holder_array[] = $timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0);
                            };
                        }
                    } elseif($timetable->getTimeHolder()->get($i)->getTimes()->getDay() == "friday") {
                        $friday[$i] = $timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getSubject()->getName();

                        if($timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getCours() != null) {
                            if(!in_array($timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getSubject()->getName(), $subject_names)) {
                                $subject_names[] = $timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getSubject()->getName();
                                $subject_holder_array[] = $timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0);
                            };
                        }
                    } elseif($timetable->getTimeHolder()->get($i)->getTimes()->getDay() == "saturday") {
                        $saturday[$i] = $timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getSubject()->getName();


                        if($timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getCours() != null) {
                            if(!in_array($timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getSubject()->getName(), $subject_names)) {
                                $subject_names[] = $timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0)->getSubject()->getName();
                                $subject_holder_array[] = $timetable->getTimeHolder()->get($i)->getSubjectHolder()->get(0);
                            };
                        }
                    }
                }
            } else {
                return $this->redirect()->toRoute('studentui_calendar_addtimetable');
            }


            $skills = $user->getSkills();
            $test_array = array();



            //Homework and Tets part
            if(!empty($subject_holder_array)) {
                for($i = 0; $i < sizeof($subject_holder_array); $i++) {
                    if($subject_holder_array[$i]->getCours()->getHomeworks() != null) {
                        for($g = 0; $g < sizeof($subject_holder_array[$i]->getCours()->getHomeworks()); $g++) {
                            if(new \DateTime("now") <= $subject_holder_array[$i]->getCours()->getHomeworks()[$g]->getExpireDate()) {
                                $homework_o = new HomeworkList();
                                $homework_o->setTitle($subject_holder_array[$i]->getCours()->getHomeworks()[$g]->getTitle());
                                $homework_o->setSubject($subject_holder_array[$i]->getSubject()->getName());
                                $homework_o->setExpiretime($subject_holder_array[$i]->getCours()->getHomeworks()[$g]->getExpireDate());
                                $homework_o->setId($subject_holder_array[$i]->getCours()->getHomeworks()[$g]->getId());
                                $homework_array[] = $homework_o;
                            }
                        }
                    }

                    if($subject_holder_array[$i]->getCours()->getTests() != null) {
                        for($g = 0; $g < sizeof($subject_holder_array[$i]->getCours()->getTests()); $g++) {
                            if(new \DateTime("now") <= $subject_holder_array[$i]->getCours()->getTests()[$g]->getExpireDate()) {
                                $test_o = new TestList();
                                $test_o->setId($subject_holder_array[$i]->getCours()->getTests()[$g]->getId());
                                $test_o->setSubject($subject_holder_array[$i]->getSubject());
                                $test_o->setTitle($subject_holder_array[$i]->getCours()->getTests()[$g]->getTitle());
                                $test_o->setExpiretime($subject_holder_array[$i]->getCours()->getTests()[$g]->getExpireDate());

                                if($skills[0] != null) {
                                    if($skills[0] != null) {
                                        for ($o = 0; $o < sizeof($user->getSkills()); $o++) {
                                            $subject_avail = $subject_holder_array[$g]->getSubject()->getId();
                                            $subject_skills = $skills[$o]->getSubject()->getId();
                                            if($subject_avail == $subject_skills) {
                                                $test_o->setLevel($skills[$o]->getLevel());
                                            }
                                        }
                                    }
                                }

                                $test_array[] = $test_o;
                            }
                        }
                    }
                }
            }

            if(!empty($homework_array)) {
                foreach ($homework_array as $key => $val) {
                    $time[$key] = $val->getExpiretime();
                }

                if(!empty($homework_array)) {
                    array_multisort($time, SORT_ASC, $homework_array);
                }
            } else {
                $homework_array = array();
            }


            return new ViewModel(array(
                "timetable_array" => $timetable,
                "times" => $times,
                "monday" => array_values($monday_array),
                "tuesday" => array_values($tuesday_array),
                "wednesday" => array_values($wednesday),
                "thursday" => array_values($thursday),
                "friday" => array_values($friday),
                "saturday" => array_values($saturday),
                'homeworks' => $homework_array,
                "tests" => $test_array
            ));
        } else {
            return $this->getServiceLocator()->get('StudentUIPermissionService')->performNoPermission($this);
        }
    }


    public function fetchHomeworks($monday_homeworks, $tuesday_homeworks, $wednesday_homeworks, $thursday_homeworks, $friday_homeworks, $saturday_homeworks) {
        $homeworks = new ArrayCollection();

        for ($a = 0; $a < sizeof($monday_homeworks); $a++) {
            $homeworks->add($monday_homeworks[$a]);
        }

        for ($d = 0; $d < sizeof($tuesday_homeworks); $d++) {
            $homeworks->add($tuesday_homeworks[$a]);
        }

        for ($e = 0; $e < sizeof($wednesday_homeworks); $e++) {
            $homeworks->add($wednesday_homeworks[$a]);
        }

        for ($v = 0; $v < sizeof($thursday_homeworks); $v++) {
            $homeworks->add($thursday_homeworks[$a]);
        }

        for ($b = 0; $b < sizeof($friday_homeworks); $b++) {
            $homeworks->add($friday_homeworks[$a]);
        }

        for ($g = 0; $g < sizeof($saturday_homeworks); $g++) {
            $homeworks->add($saturday_homeworks[$a]);
        }

        return $homeworks;
    }
}
