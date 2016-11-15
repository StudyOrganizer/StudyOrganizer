<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class EditCoursGroupController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('AdminUIPermissionService')->hasRightToAccessAdminUi($this)) {
            $this->layout('layout/layout.phtml');
            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');


            $id = $this->params('id');
            $old_cours_group = $em->getRepository('\Application\Entity\CoursGroup')->findOneById($id);
            if(!$old_cours_group == null) {
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
                    $this->editAction($em, $old_cours_group);

                    return new ViewModel(array(
                        'form' => new \Admin\Form\EditCoursGroupForm($old_cours_group->getName(), $user_option_array),
                    ));
                } else {
                    return new ViewModel(array(
                        'form' => new \Admin\Form\EditCoursGroupForm($old_cours_group->getName(), $user_option_array),
                    ));
                }
            }

            return new ViewModel(array(
                'form' => new \Admin\Form\EditCoursGroupForm("Not found", array()),
            ));
        } else {
            return $this->getServiceLocator()->get('AdminUIPermissionService')->performNoPermission($this);
        }
    }

    public function editAction($em, $old_cours_group) {
        //collect parameter
        $name = $this->getRequest()->getPost()->name;
        $select = $this->getRequest()->getPost()->select;

        /*
        * check if name is empty
        */
        if ($name != '' && $select != "") {
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

                    if (1 == 1) {
                        if($select != "not_user") {
                            $student = $em->getRepository('\Application\Entity\User')->findOneById($select)->getStudent();
                            if($student != null) {
                                $old_cours_group->setLead($student);
                            }
                        }
                        $old_cours_group->setName($coursgroupname);
                        $em->merge($old_cours_group);
                        $em->flush();

                        $this->flashMessenger()->setNamespace('success')->addMessage('Success :-) cours group changed -> '.$coursgroupname);
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
