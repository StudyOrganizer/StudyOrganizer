<?php
namespace system\V1\Rest\Documents;

use Doctrine\Common\Collections\ArrayCollection;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\Session\Container;

class DocumentsService  implements ServiceManagerAwareInterface
{

    public function isAuthMethodValid($token) {
        $em = $this->getEntityManager();
        if($this->isUserAuth($token, $em)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Gets the value of serviceManager.
     *
     * @return mixed
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * Sets the value of serviceManager.
     *
     * @param mixed $serviceManager the service manager
     *
     * @return self
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    /**
     * Adapter
     * @return type DB
     */
    public function getEntityManager() {
        return $this->serviceManager->get('doctrine.entitymanager.orm_default');
    }

    public function getTokenService() {
        return $this->serviceManager->get('TokenValidationCheckService');
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

    public function getMessages($user) {
        $documents = $user->getDocuments();
        return $documents;
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

}