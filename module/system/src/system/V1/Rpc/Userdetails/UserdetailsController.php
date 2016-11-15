<?php
namespace system\V1\Rpc\Userdetails;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\ViewModel;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Zend\Session\Container;

class UserdetailsController extends AbstractActionController
{
    public function userdetailsAction()
    {
        $em = $this->getEntityManager();
        $token = $this->getToken();

        if($this->isUserAuth($token, $em)) {
            $user = $this->getUserWithAuthMethod($token, $em);

            return new ViewModel(array(
                'status' => '200',
                "detail" => "success",
                'username' => utf8_decode($user->getUsername()),
                'firstname' => utf8_decode($user->getFirstname()),
                'lastname' => utf8_decode($user->getLastname()),
                'email' => utf8_decode($user->getEmail()),
                "avatar" => utf8_decode($user->getAvatar()),
                "location" => utf8_decode($user->getHomepage()),
                "homepage" => utf8_decode($user->getLocation())
            ));
        } else {
            return new ApiProblemResponse(new ApiProblem(403, 'not authorized'));
        }
    }

    /**
     * @param $token
     * @param $em
     * @return user
     */
    public function isUserAuth($token, $em) {
        $login = new Container('studentui_login');

        if(isset($token)) {
            $token_entity = $em->getRepository('\Application\Entity\Token')->findBy(array("token" => $token))[0];
            if($token_entity == null) {
                return false;
            }

            if($this->getTokenService()->isTokenValid($em, $token)) {
                return true;
            }
            return false;
        } elseif(isset($login->UserID)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return null
     */
    public function getToken()
    {
        if ($this->getEvent()->getRequest()->getHeaders()->get("authorization")) {
            $token = $this->getEvent()->getRequest()->getHeaders()->get("authorization")->getFieldValue();
            return $token;
        } else {
            $token = null;
            return $token;
        }
    }

    /**
     * @param $token
     * @param $em
     * @return user
     */
    public function getUserWithAuthMethod($token, $em) {
        $login = new Container('studentui_login');

        if(isset($token)) {
            $token_entity = $em->getRepository('\Application\Entity\Token')->findBy(array("token" => $token))[0];
            if($token_entity == null) {
                return false;
            }

            if($this->getTokenService()->isTokenValid($em, $token)) {
                return $this->getTokenService()->getUserAssociatedWithToken($em, $token);
            }

            return false;
        } elseif(isset($login->UserID)) {
            return $em->getRepository('\Application\Entity\User')->findBy(array("id" => $login->UserID))[0];
        } else {
            return false;
        }
    }

    public function getTokenService() {
        $sm = $this->getServiceLocator();
        return $sm->get('TokenValidationCheckService');
    }

    /**
     * Adapter
     * @return type DB
     */
    public function getEntityManager() {
        return $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
    }

}
