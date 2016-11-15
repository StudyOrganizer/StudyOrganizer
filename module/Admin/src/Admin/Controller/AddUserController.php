<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Zend\Crypt\Password\Bcrypt;
use Zend\Mail\Message;
use Zend\Mail\Transport\Sendmail as SendmailTransport;

/**
 * AddUserController - Tasks: Process Userdata and display different views.
 */
class AddUserController extends AbstractActionController
{
    public function indexAction()
    {
        //check if permission is available
        if ($this->getServiceLocator()->get('AdminUIPermissionService')->hasRightToAccessAdminUi($this)) {
            //set layout (different one for AdminUI)
            $this->layout('layout/layout.phtml');

            $container = new Container('user_progress');
            $error = new Container('progress_error');

            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            $permission_array = $this->createPermissionarray($em);
            $typ_array = $this->declareTyps();


            if ($this->getRequest()->isPost()) {
                  if(isset($this->getRequest()->getPost()->step_progress)) {
                      if($this->getRequest()->getPost()->step_progress == "2_progress") {
                          isset($this->getRequest()->getPost()->cours) ? $select_courses = $this->getRequest()->getPost()->cours : $select_courses = null;
                          $this->storeResultofStep3($select_courses, $container);
                          list($typ, $username, $firstname, $lastname, $email, $permission, $courses) = $this->restoreResultsofStep1andStep3($container);
                          return $this->returnViewModelforStep3($error, $typ, 3, $username, $firstname, $lastname, $email.$permission);
                      } elseif($this->getRequest()->getPost()->step_progress == "3_progress") {
                          list($typ, $username, $firstname, $lastname, $email, $permission, $courses) = $this->restoreResultsofStep1andStep3($container);
                          $password =  $this->createUserwithGivenData($permission, $username, $firstname, $lastname, $email, $typ, $courses);
                          return $this->returnViewModelforStep4(4, $password);
                      }
                  } else {
                      list($typ, $username, $firstname, $lastname, $email, $permission, $step) = $this->processStep1($container);
                      $this->storeResultofStep1($typ, $container, $username, $firstname, $lastname, $email, $permission);
                      if($this->validateStep1($username, $firstname, $lastname, $email, $permission, $typ)) {
                              if($step == 3) {
                              return $this->returnViewModelforStep3($error, $typ, 3, $username, $firstname, $lastname, $email);
                          }
                          $cours_array = $this->getCoursesasArray();
                          return $this->returnViewModelforStep2($error, $container, $permission_array, $typ, $cours_array, $step);
                      }
                  }
            }

            return $this->returnViewModelforStep1($error, 1, $permission_array, $typ_array);
        } else {
            return $this->getServiceLocator()->get('AdminUIPermissionService')->performNoPermission($this);
        }
    }

    /**
     * function to create random passwords.
     */
    public function createRandomPassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; ++$i) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }

        return implode($pass);
    }

    //return validation state
    public function validateStep1($username, $firstname, $lastname, $email, $permission, $typ)
    {
        $error = new Container('progress_error');

        if ($username != '' && $firstname != '' && $lastname != '' && $email != '' && $permission != ''  && $typ != '') {
            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            $validator = new \DoctrineModule\Validator\NoObjectExists(array(
            'object_repository' => $em->getRepository('\Application\Entity\User'),
            'fields' => array('username', 'email'),
          ));

            if ($validator->isValid(array('username' => $username, 'email' => $email))) {
                return true;
            } else {
                $error->message = 'user exist already';
                return false;
            }
        } else {
            $error->message = 'please supply everything :-)';
            return false;
        }
        return false;
    }

    /**
     * @param $permission
     * @return array
     */
    public function createPermissionarray($em)
    {
        //init array for permissions
        $permission_array = array();
        $permission = $em->getRepository('\Application\Entity\Permission')->findAll();

        for ($i = 0; $i < sizeof($permission); ++$i) {
            $permission_array[$permission[$i]->getID()] = utf8_encode($permission[$i]->getName());
        }
        return $permission_array;
    }

    /**
     * @return array
     */
    public function declareTyps()
    {
        $typ_array = array('student' => $this->getServiceLocator()->get('translator')->translate('Student'),
            'teacher' => $this->getServiceLocator()->get('translator')->translate('Teacher'),
            'only' => $this->getServiceLocator()->get('translator')->translate('Just User'),);
        return $typ_array;
    }

    /**
     * @param $error
     * @param $container
     * @param $permission_array
     * @param $typ_array
     * @return ViewModel
     */
    public function returnViewModelforStep1($error, $step, $permission_array, $typ_array)
    {
        if (!isset($error)) {
            $error->message = '';
        } else {
            $err_mess = $error->message;
            unset($error->message);
        }

        //process view variables that are not set yet are null
        return new ViewModel(array(
            'permission_array' => $permission_array,
            'typ_array' => $typ_array,
            'step' => 1,
            'error' => $err_mess
        ));
    }

    /**
     * @param $container
     * @return array
     */
    public function processStep1()
    {
        isset($this->getRequest()->getPost()->typ) ? $typ = $this->getRequest()->getPost()->typ : $typ = null;
        isset($this->getRequest()->getPost()->username) ? $username = $this->getRequest()->getPost()->username : $username = null;
        isset($this->getRequest()->getPost()->firstname) ? $firstname = $this->getRequest()->getPost()->firstname : $firstname = null;
        isset($this->getRequest()->getPost()->lastname) ? $lastname = $this->getRequest()->getPost()->lastname : $lastname = null;
        isset($this->getRequest()->getPost()->email) ? $email = $this->getRequest()->getPost()->email : $email = null;
        isset($this->getRequest()->getPost()->permission) ? $permission = $this->getRequest()->getPost()->permission : $permission = null;

        if (isset($this->getRequest()->getPost()->typ)) {
            if ($this->validateStep1($username, $firstname, $lastname, $email, $permission, $typ)) {
                if ($typ =='Student') {
                    $step = 2;
                } elseif ($typ == 'Teacher') {
                    $step = 2;
                } else {
                    $step = 3;
                }
                return array($typ, $username, $firstname, $lastname, $email, $permission, $step);
            }
            return array($typ, $username, $firstname, $lastname, $email, $permission, 1);
        }
        return array($typ, $username, $firstname, $lastname, $email, $permission, 1);
    }

    /**
     * @param $typ
     * @param $container
     * @param $username
     * @param $firstname
     * @param $lastname
     * @param $email
     * @param $permission
     */
    public function storeResultofStep1($typ, $container, $username, $firstname, $lastname, $email, $permission)
    {
        $container->typ = $typ;
        $container->username = $username;
        $container->firstname = $firstname;
        $container->lastname = $lastname;
        $container->email = $email;
        $container->permission = $permission;
    }

    /**
     * @param $error
     * @param $container
     * @param $permission_array
     * @param $typ_array
     * @return ViewModel
     */
    public function returnViewModelforStep2($error, $container, $permission_array, $typ, $cours_array, $step)
    {
        if (!isset($error)) {
            $error->message = '';
        } else {
            $err_mess = $error->message;
            unset($error->message);
        }

        //process view variables that are not set yet are null
        return new ViewModel(array(
            'permission_array' => $permission_array,
            'typ' => $typ,
            'step' => $step,
            'error' => $err_mess,
            'cours_array' => $cours_array
        ));
    }

    public function returnViewModelforStep3($error, $typ, $step, $username, $firstname, $lastname, $email) {
        if (!isset($error)) {
            $error->message = '';
        } else {
            $err_mess = $error->message;
            unset($error->message);
        }

        return new ViewModel(array(
            'typ' => $typ,
            'step' => $step,
            'error' => $err_mess,
            'username' => $username,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email
        ));
    }

    public function returnViewModelforStep4($step, $password) {
        return new ViewModel(array(
            'step' => $step,
            'password' => $password,
        ));
    }

    /**
     * @param $cours_array
     */
    public function getCoursesasArray()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $cours = $em->getRepository('\Application\Entity\Cours')->findAll(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        for ($i = 0; $i < sizeof($cours); ++$i) {
            $cours_array[$cours[$i]->getId()] = $cours[$i]->getName() . ' (' . $cours[$i]->getSchool()->getName() . ')';
        }
        return $cours_array;
    }

    /**
     * @param $container
     */
    public function restoreResultsofStep1andStep3($container)
    {
        $typ = $container->typ;
        $username = $container->username;
        $firstname = $container->firstname;
        $lastname = $container->lastname;
        $email = $container->email;
        $permission = $container->permission;
        $courses = $container->courses;
        return array($typ, $username, $firstname, $lastname, $email, $permission, $courses);
    }

    /**
     * @param $select_courses
     * @param $container
     */
    public function storeResultofStep3($select_courses, $container)
    {
        $container->courses = $select_courses;
    }

    /**
     * @param $permission
     * @param $username
     * @param $firstname
     * @param $lastname
     * @param $email
     * @param $typ
     * @param $courses
     * @return string
     */
    public function createUserwithGivenData($permission, $username, $firstname, $lastname, $email, $typ, $courses)
    {
        isset($this->getRequest()->getPost()->email_opt) ? $email_opt = $this->getRequest()->getPost()->email_opt : $email_opt = null;

        //create password
        $password = $this->createRandomPassword();
        $bcrypt = new Bcrypt();
        $password_hash = $bcrypt->create($password);

        //get doctrine2
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        //get permission entity
        $permission_e = $em->getRepository('\Application\Entity\Permission')->findOneById($permission);

        $newUser = new \Application\Entity\User();
        $newUser->setUsername(utf8_decode($username));
        $newUser->setFirstName(utf8_decode($firstname));
        $newUser->setLastName(utf8_decode($lastname));
        $newUser->setEmail($email);
        $newUser->setPermission($permission_e);
        $newUser->setPassword($password_hash);
        $newUser->setFirstlogin(true);
        $em->persist($newUser);
        $em->flush();

        if ($typ == 'Student') {
            $newStudent = new \Application\Entity\Student();

            for ($f = 0; sizeof($courses) > $f; $f++) {
                $newStudent->addCours($em->getRepository('\Application\Entity\Cours')->findOneById($courses[$f]));
            }

            $newStudent->setSchool($em->getRepository('\Application\Entity\Cours')->findOneById(array('name' => $courses[0]))->getSchool());
            $newStudent->setUser($newUser);
            $em->persist($newStudent);
            $em->flush();

            $newUser->setStudent($newStudent);
            $em->merge($newUser);
            $em->flush();
        }

        if($typ == 'Teacher') {
            //$newTeacher = new \Application\Entity\Teacher();
            //$newTeacher->setSchool($em->getRepository('\Application\Entity\Cours')->findOneById(array('name' => $courses[0]))->getSchool());
        }

        if($email_opt) {
            if ($typ == 'Student') {
                $this->sendEMail($firstname, $username, $password, $email, "beemo@studyorganizer.de");
            } else {
                $this->sendEMail($firstname, $username, $password, $email, "beemo@studyorganizer.de");
            }
        }


        return $password;
    }

    public function sendEMail($firstname, $username, $pw, $target, $from) {
        if($target != null && $from != null) {

            $html = '
<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Willkommen bei StudyOrganizer</title>
<style>
/* -------------------------------------
    GLOBAL
------------------------------------- */
* {
  font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
  font-size: 100%;
  line-height: 1.6em;
  margin: 0;
  padding: 0;
}
img {
  max-width: 600px;
  width: 100%;
}
body {
  -webkit-font-smoothing: antialiased;
  height: 100%;
  -webkit-text-size-adjust: none;
  width: 100% !important;
}
/* -------------------------------------
    ELEMENTS
------------------------------------- */
a {
  color: #348eda;
}
.btn-primary {
  Margin-bottom: 10px;
  width: auto !important;
}
.btn-primary td {
  background-color: #348eda;
  border-radius: 25px;
  font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
  font-size: 14px;
  text-align: center;
  vertical-align: top;
}
.btn-primary td a {
  background-color: #348eda;
  border: solid 1px #348eda;
  border-radius: 25px;
  border-width: 10px 20px;
  display: inline-block;
  color: #ffffff;
  cursor: pointer;
  font-weight: bold;
  line-height: 2;
  text-decoration: none;
}
.last {
  margin-bottom: 0;
}
.first {
  margin-top: 0;
}
.padding {
  padding: 10px 0;
}
/* -------------------------------------
    BODY
------------------------------------- */
table.body-wrap {
  padding: 20px;
  width: 100%;
}
table.body-wrap .container {
  border: 1px solid #f0f0f0;
}
/* -------------------------------------
    FOOTER
------------------------------------- */
table.footer-wrap {
  clear: both !important;
  width: 100%;
}
.footer-wrap .container p {
  color: #666666;
  font-size: 12px;

}
table.footer-wrap a {
  color: #999999;
}
/* -------------------------------------
    TYPOGRAPHY
------------------------------------- */
h1,
h2,
h3 {
  color: #111111;
  font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
  font-weight: 200;
  line-height: 1.2em;
  margin: 40px 0 10px;
}
h1 {
  font-size: 36px;
}
h2 {
  font-size: 28px;
}
h3 {
  font-size: 22px;
}
p,
ul,
ol {
  font-size: 14px;
  font-weight: normal;
  margin-bottom: 10px;
}
ul li,
ol li {
  margin-left: 5px;
  list-style-position: inside;
}
/* ---------------------------------------------------
    RESPONSIVENESS
------------------------------------------------------ */
/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
.container {
  clear: both !important;
  display: block !important;
  Margin: 0 auto !important;
  max-width: 600px !important;
}
/* Set the padding on the td rather than the div for Outlook compatibility */
.body-wrap .container {
  padding: 20px;
}
/* This should also be a block element, so that it will fill 100% of the .container */
.content {
  display: block;
  margin: 0 auto;
  max-width: 600px;
}

.content table {
  width: 100%;
}
</style>
</head>

<body bgcolor="#f6f6f6">

        <!-- body -->
<table class="body-wrap" bgcolor="#f6f6f6">
  <tr>
    <td></td>
    <td class="container" bgcolor="#FFFFFF">

      <!-- content -->
      <div class="content">
      <table>
        <tr>
            <div class="text-align:center;">
                <img src="https://server1.studyorganizer.de/img/assets/logo.svg" alt="test" />
            </div>
            <p>Hallo ' . $firstname . ', herzlich Willkommen bei StudyOrganizer!</p>
            <p>Schön, dass du Interesse hast unsere Software zu nutzen. Mit dieser Email senden wir dir deine Zugangsdaten, die Du für die erste Anmeldung brauchst.</p>
            <p>Hier sind ein paar erste Schritte, die Du befolgen solltest:</p>
            <ul>
                <li>1. Ändere bitte sofort nach dem ersten Login Dein Passwort unter >Mein Account< - >Einstellungen<. (Den Zahlen- und Buchstabensalat kann sich eh keiner merken ;-P )</li>
                <li>2. Unsere Software benötigt deinen korrekten Stundenplan, denn über den Stundenplan werden die Zuordnungen zu deinen Hausaufgaben, Klassenarbeiten und anderen Terminen hergestellt. Du kannst ihn eintragen, indem du oben auf das >Kalender<-Icon drückst.</li>
                <li>3. Damit StudyOrganizer Dir anzeigen kann, in welchen Fächern Du wann mit Lernen beginnen solltest, musst du unter >Mein Account< >Einstellungen<-  >Fähigkeiten< eintragen, wie gut oder schlecht du in einem Fach bist.</li>
                <li>4. Wenn du diese Schritte befolgt hast, steht einem gut organisierten Schulalltag so gut wie nichts mehr im Wege :)</li>
            </ul>
            <br />
            <p>Deine Benutzerdaten: <br />
            Benutzername: '.$username.' <br />
            Passwort: '.$pw.'</p> <br/>
            <!-- button -->
            <table class="btn-primary" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td>
                  <a href="https://cbs.studyorganizer.de/login">CBS-Login</a>
                </td>
              </tr>
            </table>
            <!-- /button -->
            <p>Viel Spaß</p>
            <p>Das StudyOrganizer Team</p>
          </td>
        </tr>
      </table>
      </div>
      <!-- /content -->

    </td>
    <td></td>
  </tr>
</table>
<!-- /body -->

<!-- footer -->
<table class="footer-wrap">
  <tr>
    <td></td>
    <td class="container">

      <!-- content -->
      <div class="content">
        <table>
          <tr>
            <td align="center">
              <p>&copy; 2016 StudyOrganizer. Alle Rechte vorbhalten.</a>
              </p>
            </td>
          </tr>
        </table>
      </div>
      <!-- /content -->

    </td>
    <td></td>
  </tr>
</table>
<!-- /footer -->

</body>
</html>';

            $message = new Message();
            $message->addFrom($from, "StudyOrganizer")
                ->addTo($target)
                ->setSubject("Willkommen bei StudyOrganizer");
            $bodyMessage = new \Zend\Mime\Part($html);
            $bodyPart = new \Zend\Mime\Message();
            $message->addReplyTo("bjoern.ternes@gmail.com", "Björn Ternes");
            $message->setEncoding("UTF-8");
            $bodyMessage->type = 'text/html';
            $bodyPart->setParts(array($bodyMessage));
            $message->setBody($bodyPart);
            $transport = new SendmailTransport();
            $transport->send($message);
        }
    }
}
