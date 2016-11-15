<?php
namespace ajax\V1\Rest\Messages;

use Doctrine\Common\Collections\ArrayCollection;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\Session\Container;

class MessagesService implements ServiceManagerAwareInterface {

    /**
     * @param $user
     * @return ArrayCollection
     */
    public function getMessages($user) {
        $cards = $this->fetchCards($user);
        return $cards;
    }

    public function isAuthMethodValid($token) {
        $em = $this->getEntityManager();
        if($this->isUserAuth($token, $em)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getMessage($id) {
        $em = $this->getEntityManager();      
        $entity = $em->getRepository('\Application\Entity\StudentUIDashboardCard')->findBy(array("id" => $id));
        return $entity[0];
    }

    public function createMessage($data, $token, $context)
    {
        if ($data != "") {
            $em = $this->getEntityManager();

            $user_entity = $this->getUserWithAuthMethod($token, $em);

            if($user_entity->getMute()) {
                return "forbidden";
            } else {
                $hashtag_validator = $this->validateHashtags($em);
                $username_validator = $this->validateUsername($em);
                $cours_validator = $this->validateCours($em);
                $school_validator = $this->validate_school($em);
                $usergroup_validator = $this->validateUserGroup($em);

                $escaper = new \Zend\Escaper\Escaper('utf-8');
                $escaped_content = $escaper->escapeHtml($data->content);
                $newCard = $this->createNewMessageCard($escaped_content, $user_entity, $em);

                $this->addHashtags($data, $hashtag_validator, $newCard, $em);
                $this->addStudents($data, $username_validator, $em, $newCard);
                $this->addCourses($data, $cours_validator, $em, $newCard);
                $this->addSchools($data, $school_validator, $em, $newCard);
                $this->addUserGroups($data, $usergroup_validator, $em, $newCard);
            }


            return "success";
        } else {
            return "no_validate_data";
        }
    }

    public function parseHashtag($content)
    {
        $pattern = "/(?:^|\s)(\#\w+)/";
        preg_match_all($pattern, $content, $matches, PREG_OFFSET_CAPTURE);

        return $matches[0];
    }

    public function parseTarget($content)
    {
        $pattern = "/(?:^|\s)(\@\w+)/";
        preg_match_all($pattern, $content, $matches, PREG_OFFSET_CAPTURE);

        return $matches[0];
    }

    public function parseTargetLong($content)
    {
        $pattern = "(@(\'{1,1}([^\']+)\'{1,1}|[^@\ ]+))";
        preg_match_all($pattern, $content, $matches, PREG_OFFSET_CAPTURE);

        return $matches[1];
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
     * @param $em
     */
    public function validateHashtags($em)
    {
        return $hastag_validator = new \DoctrineModule\Validator\NoObjectExists(array(
            // object repository to lookup
            'object_repository' => $em->getRepository('\Application\Entity\Hashtag'),
            // fields to match
            'fields' => array('name'),
        ));
    }

    /**
     * @param $em
     */
    public function validateUsername($em)
    {
        return $username_validator = new \DoctrineModule\Validator\NoObjectExists(array(
            // object repository to lookup
            'object_repository' => $em->getRepository('\Application\Entity\User'),
            // fields to match
            'fields' => array('username'),
        ));
    }

    /**
     * @param $escaped_content
     * @param $user_entity
     * @param $em
     * @return \Application\Entity\StudentUIDashboardCard
     */
    public function createNewMessageCard($escaped_content, $user_entity, $em)
    {
        //init new card (message in this case)
        $newCard = new \Application\Entity\StudentUIDashboardCard();
        //doesn´t matter yet
        $newCard->setTitle('Message');
        //intern redirect url -> "" if message without no document linked
        $newCard->setIntern_url('');
        $newCard->setTyp('message');
        $newCard->setRemimberDate(new \DateTime('now'));
        $newCard->setUpdated();
        $newCard->setContent($escaped_content);
        $newCard->setVisible(true);
        $newCard->setAuthor($user_entity->getStudent());
        $em->persist($newCard);
        $em->flush();
        return $newCard;
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

    /**
     * @param $data
     * @param $username_validator
     * @param $em
     * @param $newCard
     * @return int
     */
    public function addStudents($data, $username_validator, $em, $newCard)
    {
        //add students
        $targets_username = $this->parseTarget($data->content);

        for ($i = 0; $i < sizeof($targets_username); ++$i) {
            //check if username
            if (!$username_validator->isValid(array('username' => substr(trim($targets_username[$i][0]), 1)))) {
                $user = $em->getRepository('\Application\Entity\User')->findBy(array('username' => substr(trim($targets_username[$i][0]), 1)));

                if ($user[0]->getStudent() != '') {
                    $student = $user[0]->getStudent();
                    $student->addStudentUICard($newCard);
                    $em->persist($student);
                    $em->flush();
                }
            }
        }
    }

    /**
     * @param $data
     * @param $hashtag_validator
     * @param $newCard
     * @param $em
     * @return array
     */
    public function addHashtags($data, $hashtag_validator, $newCard, $em)
    {
        $hastagsfrompost = $this->parseHashtag($data->content);

        //add hastags to card
        for ($i = 0; $i < sizeof($hastagsfrompost); ++$i) {
            if ($hashtag_validator->isValid(array('name' => $hastagsfrompost[$i][0]))) {
                //init hashtag
                $newHashtag = new \Application\Entity\Hashtag();
                //set name
                $newHashtag->setName($hastagsfrompost[$i][0]);
                //add relation to card
                $newHashtag->addStudentUICard($newCard);
                //create update to db
                $em->persist($newHashtag);
                $em->flush();
            } else {
                //fetch already exist hashtag
                $hashtag = $em->getRepository('\Application\Entity\Hashtag')->findBy(array('name' => $hastagsfrompost[$i][0]));
                //add card
                $hashtag[0]->addStudentUICard($newCard);
                //perform update to db
                $em->persist($hashtag[0]);
                $em->flush();
            }
        }
    }

    /**
     * @param $em
     */
    public function validateCours($em)
    {
        return $cours_validator = new \DoctrineModule\Validator\NoObjectExists(array(
            // object repository to lookup
            'object_repository' => $em->getRepository('\Application\Entity\Cours'),
            // fields to match
            'fields' => array('name'),
        ));
    }

    /**
     * @param $data
     * @param $cours_validator
     * @param $em
     * @param $newCard
     */
    public function addCourses($data, $cours_validator, $em, $newCard)
    {
        $targets_cours = $this->parseTargetLong($data->content);

        for ($i = 0; $i < sizeof($targets_cours); ++$i) {
            if (!$cours_validator->isValid(array('name' => substr(trim($targets_cours[$i][0]), 1, -1)))) {
                $cours = $em->getRepository('\Application\Entity\Cours')->findBy(array('name' => substr(trim($targets_cours[$i][0]), 1, -1)));
                $cours[0]->addDashboardCard($newCard);
                $em->persist($cours[0]);
                $em->flush();
            }
        }
    }

    /**
     * @param $data
     * @param $cours_validator
     * @param $em
     * @param $newCard
     */
    public function addSchools($data, $school_validator, $em, $newCard)
    {
        $targets_school = $this->parseTargetLong($data->content);

        for ($i = 0; $i < sizeof($targets_school); ++$i) {
            if (!$school_validator->isValid(array('name' => substr(trim($targets_school[$i][0]), 1, -1)))) {
                $school = $em->getRepository('\Application\Entity\School')->findBy(array('name' => substr(trim($targets_school[$i][0]), 1, -1)));
                $school[0]->addDashboardCard($newCard);
                $em->persist($school[0]);
                $em->flush();
            }
        }
    }

    /**
     * @param $em
     */
    public function validate_school($em)
    {
        return $school_validator = new \DoctrineModule\Validator\NoObjectExists(array(
            // object repository to lookup
            'object_repository' => $em->getRepository('\Application\Entity\School'),
            // fields to match
            'fields' => array('name'),
        ));
    }

    /**
     * @param $em
     * @return \DoctrineModule\Validator\NoObjectExists
     */
    public function validateUserGroup($em)
    {
        $usergroup_validator = new \DoctrineModule\Validator\NoObjectExists(array(
            // object repository to lookup
            'object_repository' => $em->getRepository('\Application\Entity\UserGroup'),
            // fields to match
            'fields' => array('name'),
        ));
        return $usergroup_validator;
    }

    /**
     * @param $data
     * @param $usergroup_validator
     * @param $em
     * @param $newCard
     */
    public function addUserGroups($data, $usergroup_validator, $em, $newCard)
    {
        $targetsusergroup = $this->parseTargetLong($data->content);

        for ($i = 0; $i < sizeof($targetsusergroup); ++$i) {
            if (!$usergroup_validator->isValid(array('name' => substr(trim($targetsusergroup[$i][0]), 1, -1)))) {
                $usergroup = $em->getRepository('\Application\Entity\UserGroup')->findBy(array('name' => substr(trim($targetsusergroup[$i][0]), 1, -1)));
                $usergroup[0]->addDashboardCard($newCard);
                $em->persist($usergroup[0]);
                $em->flush();
            }
        }
    }

    /**
     * @param $user
     * @param $time
     * @return ArrayCollection
     */
    public function fetchCards($user)
    {
        $cardsbyuser = $user->getStudent()->getAuthorCard();
        $cardsmentionedbyusertag = $user->getStudent()->getDashboardCards();
        $usergroups = $user->getUser_groups();
        $schoolcards = $user->getStudent()->getSchool()->getDashboardCards();

        $courses_array = $user->getStudent()->getCourses();
        $cards_merge = new ArrayCollection();


        for ($a = 0; $a < sizeof($courses_array); $a++) {
            if (sizeof($courses_array[$a]->getDashboardCards()) != 0) {
                for ($s = 0; $s < sizeof($courses_array[$a]->getDashboardCards()); $s++) {
                    $cards_merge->add($courses_array[$a]->getDashboardCards()->get($s));
                }
            }
        }

        for ($d = 0; $d < sizeof($cardsbyuser); $d++) {
            $cards_merge->add($cardsbyuser->get($d));
        }

        for ($e = 0; $e < sizeof($cardsmentionedbyusertag); $e++) {
            $cards_merge->add($cardsmentionedbyusertag->get($e));
        }

        for ($v = 0; $v < sizeof($usergroups); $v++) {
            $cards_merge->add($usergroups->get($v));
        }

        for ($b = 0; $b < sizeof($schoolcards); $b++) {
            $cards_merge->add($schoolcards->get($b));
        }

        $cardsasarray = array_unique($cards_merge->toArray(), SORT_REGULAR);

        foreach ($cardsasarray as $key => $val) {
            $time[$key] = $val->getUpdated();
        }

        if(!empty($cardsasarray)) {
            array_multisort($time, SORT_DESC, $cardsasarray);
        }

        for ($h = 0; $h < sizeof($cardsasarray); $h++) {
            $cardsasarray[$h]->setContent($cardsasarray[$h]->getHTMLContent());
        }

        $cards = new ArrayCollection($cardsasarray);
        return $cards;
    }
}