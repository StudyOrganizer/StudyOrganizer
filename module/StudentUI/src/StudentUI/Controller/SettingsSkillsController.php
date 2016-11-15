<?php
namespace StudentUI\Controller;

use Application\Entity\Skill;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;


class SettingsSkillsController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('StudentUIPermissionService')->hasRightToAccessStudentUI($this)) {
            $this->layout('layout/studentui.phtml');
            $login = new Container('studentui_login');
            $avatar = $login->avatar;

            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            $subjects = $em->getRepository('\Application\Entity\Subject')->findAll();
            $user = $em->getRepository('\Application\Entity\User')->findOneById($login->UserID);

            if ($this->getRequest()->isPost()) {
                $this->changeSkill($em, $subjects, $user);
            }

            $preset_values = array();
            $skills = $user->getSkills();

            if($skills[0] != null) {
                for ($i = 0; $i < sizeof($user->getSkills()); $i++) {
                    $preset_values[] = $user->getSkills()[$i]->getLevel();
                }
            }

            return new ViewModel(array(
                "subjects" => $subjects,
                "preset" => $preset_values,
                "avatar" => $avatar
            ));
        } else {
            return $this->getServiceLocator()->get('StudentUIPermissionService')->performNoPermission($this);
        }
    }

    public function changeSkill($em, $subjects, $user)
    {
        $skills_array = array();
        $subjects_array = array();

        for ($i = 0; $i < sizeof($subjects); $i++) {
            $id = $subjects[$i]->getID();
            $skills_array[] = $this->getRequest()->getPost()["level" . $id];
            $subjects_array[] = $subjects[$i];
        }

        $skills = $user->getSkills();

        if($skills[0] != null) {
            if($skills[0] != null) {
                for ($i = 0; $i < sizeof($user->getSkills()); $i++) {
                    $skill = $user->getSkills()[$i];
                    $skill->setSubject($subjects_array[$i]);
                    $skill->setLevel($skills_array[$i]);
                    $em->merge($skill);
                    $em->flush();
                }
            }
        } else {
            for ($i = 0; $i < sizeof($skills_array); $i++) {
                $newSkill = new Skill();
                $newSkill->setSubject($subjects_array[$i]);
                $newSkill->setLevel($skills_array[$i]);
                $newSkill->setUser($user);
                $em->persist($newSkill);
                $em->flush();
            }
        }


    }
}
