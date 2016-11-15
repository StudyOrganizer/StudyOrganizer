<?php
namespace Application\Service;

/**
 * Handle access to api via token
 */
class TokenValidationCheckService
{
    public function isTokenValid($em, $token)
    {
        $tokenobject = $em->getRepository('\Application\Entity\Token')->findBy(array("token" => $token))[0];
        $now = new \DateTime("now");

        if($now > $tokenobject->getValidStart() && $now < $tokenobject->getValidEnd()) {
            if($this->getUserAssociatedWithToken($em, $token)->getPermission()->getCAN_LOGIN()) {
                if($this->getUserAssociatedWithToken($em, $token)->getPermission()->getCAN_ACCESS_STUDENT_AREA()) {
                    return true;
                }
            }
        }
        
        return false;
    }
    
    public function getUserAssociatedWithToken($em, $token) {
        $tokenobject = $em->getRepository('\Application\Entity\Token')->findBy(array("token" => $token))[0];
        return $tokenobject->getUser();
    }
}
