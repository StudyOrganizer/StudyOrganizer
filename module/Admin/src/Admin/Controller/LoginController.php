<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Assetic\Exception\Exception;
use Zend\Crypt\Password\Bcrypt;

class LoginController extends AbstractActionController
{
    public function indexAction()
    {
        $login = new Container('adminui_login');
        if (isset($login->UserID)) {
            return $this->redirect()->toRoute('admin_dashboard');
        }

        if (isset($login->message)) {
            $message = $login->message;
            unset($login->message);
        } else {
            $message = '';
        }

        $this->layout('layout/empty.phtml');

        if ($this->getRequest()->isPost()) {
            $username = $this->getRequest()->getPost()->username;
            $password = $this->getRequest()->getPost()->password;

            if ($username != ''  && $password != '') {
                try {
                    $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

                    $user = $em->getRepository('\Application\Entity\User')->findBy(array('username' => $username));
                    if ($user != null) {
                        $password_hash = $user[0]->getPassword();
                        $bcrypt = new Bcrypt();

                        if ($bcrypt->verify($password, $password_hash)) {
                            //case password correct

                            if ($user[0]->getPermission()->getCAN_LOGIN()) {
                                if ($user[0]->getPermission()->getCAN_ACCESS_ADMIN_AREA()) {
                                    $login->UserID = $user[0]->getID();

                                    return $this->redirect()->toRoute('admin_dashboard');
                                } else {
                                    $translator = $this->getServiceLocator()->get('translator');
                                    $message = $translator->translate('You dont have the permission to access the AdminUI');
                                }
                            } else {
                                $translator = $this->getServiceLocator()->get('translator');
                                $message = $translator->translate('You dont have the permission to login');
                            }
                        } else {
                            $translator = $this->getServiceLocator()->get('translator');
                            $message = $translator->translate('Check your details, the provided password is wrong');
                        }
                    } else {
                        $translator = $this->getServiceLocator()->get('translator');
                        $message = $translator->translate('Check your details, the user doesnt exist');
                    }
                } catch (Exception $e) {
                    return $this->redirect()->toRoute('setupwelcome');
                }
            } else {
                $message = 'Please supply everything';
            }
        }

        return new ViewModel(array(
              'message' => $message,
        ));
    }
}
