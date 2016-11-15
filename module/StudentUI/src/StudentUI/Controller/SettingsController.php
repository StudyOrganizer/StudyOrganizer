<?php

namespace StudentUI\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Zend\Crypt\Password\Bcrypt;

class SettingsController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('StudentUIPermissionService')->hasRightToAccessStudentUI($this)) {
            $this->layout('layout/studentui.phtml');
            $login = new Container('studentui_login');

            if ($this->getRequest()->isPost()) {
                $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
                $this->changeProfile($em);
            }

            $firstname = $login->UserFirstname;
            $lastname = $login->UserLastname;
            $location = $login->UserLocation;
            $website = $login->UserHomepage;
            $aboutme = $login->UserAboutMe;
            $avatar = $login->avatar;

            return new ViewModel(array(
                'email' => md5($login->UserEMAIL),
                'firstname' => $firstname,
                'lastname' => $lastname,
                'location' => $location,
                'website' => $website,
                'avatar' => $avatar,
                'aboutme' => $aboutme,
            ));
        } else {
            return $this->getServiceLocator()->get('StudentUIPermissionService')->performNoPermission($this);
        }
    }

    public function changeProfile($em)
    {
        $current = $this->getRequest()->getPost()->current;
        $new = $this->getRequest()->getPost()->new;
        $rnew = $this->getRequest()->getPost()->rnew;
        $website = $this->getRequest()->getPost()->website;
        $firstname = $this->getRequest()->getPost()->firstname;
        $lastname = $this->getRequest()->getPost()->lastname;
        $aboutme = $this->getRequest()->getPost()->aboutme;
        $location = $this->getRequest()->getPost()->location;

        $login = new Container('studentui_login');

        if ($current != '') {
            $user = $em->getRepository('\Application\Entity\User')->findOneById($login->UserID);
            $bcrypt = new Bcrypt();
            $old_hash = $user->getPassword();

            if ($bcrypt->verify($current, $old_hash)) {
                if ($new != '' && $rnew != '') {
                    if ($new == $rnew) {
                        if ($new < 4) {
                            $password_hash = $bcrypt->create($new);

                            $user->setPassword($password_hash);
                            $em->merge($user);
                            $em->flush();

                            $this->flashMessenger()->setNamespace('success')->addMessage('Settings changed');
                        } else {
                            $this->flashMessenger()->setNamespace('error')->addMessage('Error :-( The new password is too short :(');
                        }
                    } else {
                        $this->flashMessenger()->setNamespace('error')->addMessage('Error :-( The passwords doesnt match :(');
                    }
                }

                if ($user->getPermission()->getCAN_UPDATE_PROFILE_PRIVATE()) {
                    if ($website != '' || $firstname != '' || $lastname != '' || $lastname != '' || $aboutme != '' || $location != '') {
                        $user->setFirstname(utf8_decode($firstname));
                        $user->setLastname(utf8_decode($lastname));
                        $user->setHomepage(utf8_decode($location));
                        $user->setLocation(utf8_decode($website));
                        $user->setAboutMe(utf8_decode($aboutme));
                        $em->merge($user);
                        $em->flush();

                        $login->UserFirstname = utf8_decode($firstname);
                        $login->UserLastname = utf8_decode($lastname);
                        $login->UserLocation = utf8_decode($location);
                        $login->UserHomepage = utf8_decode($website);
                        $login->UserAboutMe = utf8_decode($aboutme);

                        $this->flashMessenger()->setNamespace('success')->addMessage('Settings changed');
                    }
                } else {
                    $this->flashMessenger()->setNamespace('error')->addMessage('Error :-( You dont have the needed permission to do this :(');
                }
            } else {
                $this->flashMessenger()->setNamespace('error')->addMessage('Error :-( Current password is wrong :(');
            }
        } else {
            $this->flashMessenger()->setNamespace('error')->addMessage('Error :-( Current password is required');
        }

        return $this->redirect()->toRoute('studentui_settings');
    }
}
