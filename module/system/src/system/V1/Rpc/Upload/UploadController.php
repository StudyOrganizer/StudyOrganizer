<?php
namespace system\V1\Rpc\Upload;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\ViewModel;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Zend\Session\Container;

class UploadController extends AbstractActionController
{
    public function uploadAction()
    {
        $file = $this->getRequest()->getFiles()->toArray();
        $typ =  $this->getRequest()->getPost()->typ;
        $em = $this->getEntityManager();
        $token = $this->getToken();

        if($this->isUserAuth($token, $em)) {
            $user = $this->getUserWithAuthMethod($token, $em);

            if($typ == "avatar" && getimagesize($file["file"]["tmp_name"])) {
                 $filename =  uniqid().$file["file"]["name"];

                 move_uploaded_file($file["file"]["tmp_name"], "user_data/avatars/".$filename);

                 $user->setAvatar(preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename));
                 $em->merge($user);
                 $em->flush();
                 return new ApiProblemResponse(new ApiProblem(200, 'success'));
             } else {
                return new ApiProblemResponse(new ApiProblem(500, 'no images'));
             }
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
    
    public function getTokenService() {
        $sm = $this->getServiceLocator();
        return $sm->get('TokenValidationCheckService');
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
     * Adapter
     * @return type DB
     */
    public function getEntityManager() {
        return $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
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
