<?php
namespace system\V1\Rpc\Login;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\ViewModel;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Zend\Crypt\Password\Bcrypt;

class LoginController extends AbstractActionController
{
    public function loginAction()
    {
        $request = json_decode($this->getRequest()->getContent());
        $username = $request->username;
        $password = $request->password;
        $deviceOS = $request->device_os == null ? $request->device_os = "default" : $request->device_os;
        $deviceName =  $request->device_name == null ? $request->device_name = "default" : $request->device_name;

        if($username != "" && $password != "" && $deviceOS != "" && $deviceName != "") { 
            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

            $user = $em->getRepository('\Application\Entity\User')->findBy(array('username' => $username));
            if ($user != null) {
                $password_hash = $user[0]->getPassword();
                $bcrypt = new Bcrypt();

                if ($bcrypt->verify($password, $password_hash)) {
                    if ($user[0]->getPermission()->getCAN_LOGIN()) {
                        if ($user[0]->getPermission()->getCAN_ACCESS_STUDENT_AREA()) {
                            $tokenGen = $this->generateRandomString();
                            $token = new \Application\Entity\Token();
                            $token->setDeviceName($deviceName);
                            $token->setDeviceOS($deviceOS);
                            $token->setUser($user[0]);
                            $token->setToken($tokenGen);
                            $token->setValidStart(); //this is now
                            $validEnd = new \DateTime('now');
                            $validEnd->add(new \DateInterval('P2Y5M4DT4H3M2S'));
                            $token->setValidEnd($validEnd);
                            $em->persist($token);
                            $em->flush();
                            
                            return new ViewModel(array(
                                'status' => '200',
                                "detail" => "success",
                                'username' => $username,
                                'token' => $tokenGen,
                                'expires' => $validEnd 
                           ));           
                        } else {
                            return new ApiProblemResponse(new ApiProblem(403, 'no permission for studentui'));
                        }
                    } else {
                        return new ApiProblemResponse(new ApiProblem(403, 'no permission to login'));
                    }
                } else {
                    return new ApiProblemResponse(new ApiProblem(403, 'wrong password'));
                }
            } else {
                return new ApiProblemResponse(new ApiProblem(404, 'user not found'));
            }
        } else {
             return new ApiProblemResponse(new ApiProblem(412, 'Missing details'));
        }

    }
    
    function generateRandomString($length = 64) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
