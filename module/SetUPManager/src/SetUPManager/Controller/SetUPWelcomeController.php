<?php

namespace SetUPManager\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Crypt\Password\Bcrypt;

class SetUPWelcomeController extends AbstractActionController
{
    public function indexAction()
    {
        $this->layout('layout/installation_layout.phtml');
        //check if SetUP locked (auto lock if any user exists)
        try {
            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            $validator = new \DoctrineModule\Validator\NoObjectExists(array(
                    'object_repository' => $em->getRepository('\Application\Entity\User'),
                    'fields' => array('id'),
            ));

            if (!$validator->isValid(array('id' => 1))) {
                $validation = true;
            }
        } catch (\Exception $e) {
            $validation = false;
        }

        if ($validation) {
            return new ViewModel(array(
                    'locked' => true,
            ));
        } else {

        //language part
        $language = 'en_GB';

        if ($this->params()->fromQuery('l') == 'de_DE') {
            $language = 'de_DE';
        }

        //check if config is needed
        $db_c = file_exists('config/autoload/database.local.php');
        $local_config = file_exists('config/autoload/config.local.php');

        //check data dir
        $dir = 'user_data';
            $avatar_dir = $dir.'/avatars';
            $files = $dir.'/files';
            if (!is_dir($dir)) {
                mkdir($dir);
            }
            if (!is_dir($avatar_dir)) {
                mkdir($avatar_dir);
            }
            if (!is_dir($files)) {
                mkdir($files);
            }

            try {
                $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
                $em->getConnection()->connect();
                $db_conn = true;
            } catch (\Exception $e) {
                $db_conn = false;
            }
            
        //check dirs if writable
        $data_w = is_writable($dir);
        $avatars_w = is_writable($avatar_dir);
        $files_w = is_writable($files);

            if ($this->getRequest()->isPost()) {
                $title = $this->getRequest()->getPost()->title;
                $desc = $this->getRequest()->getPost()->desc;
                $keywords = $this->getRequest()->getPost()->keywords;
                $lang = $this->getRequest()->getPost()->lang;

                if ($title != '' && $desc != '' && $keywords != '' && $lang != '') {
                    $fp = fopen('config/autoload/config.local.php', 'w');
                    $config = new \Zend\Config\Config(array(), true);
                    $config->settings = array();

                    $config->settings->title = $title;
                    $config->settings->desc = $desc;
                    $config->settings->keywords = $keywords;
                    $config->settings->language = $lang;

                    $writer = new \Zend\Config\Writer\PhpArray();

                    fwrite($fp, $writer->toString($config));
                    fclose($fp);
                } else {
                    $this->flashMessenger()->setNamespace('error')->addMessage('[MAIN] Error :-( Please supply everything');
                }

                $host = $this->getRequest()->getPost()->host;
                $port = $this->getRequest()->getPost()->port;
                $db_post_name = $this->getRequest()->getPost()->db_name;
                $db_post_username = $this->getRequest()->getPost()->username;
                $db_post_password = $this->getRequest()->getPost()->password;

                if ($host != '' && $port != '' && $db_post_name != '' && $db_post_username != '' && $db_post_password != '') {
                    $fp = fopen('config/autoload/database.local.php', 'w');
                    $config = new \Zend\Config\Config(array(), true);
                    $config->doctrine = array();

                    $config->doctrine->connection = array();
                    $config->doctrine->connection->orm_default = array();
                    $config->doctrine->connection->orm_default->driverClass = 'Doctrine\DBAL\Driver\PDOMySql\Driver';
                    $config->doctrine->connection->orm_default->params = array();
                    $config->doctrine->connection->orm_default->params->host = $host;
                    $config->doctrine->connection->orm_default->params->port = $port;
                    $config->doctrine->connection->orm_default->params->user = $db_post_username;
                    $config->doctrine->connection->orm_default->params->password = $db_post_password;
                    $config->doctrine->connection->orm_default->params->dbname = $db_post_name;
                    $writer = new \Zend\Config\Writer\PhpArray();

                    fwrite($fp, $writer->toString($config));
                    fclose($fp);

                    try {
                        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
                        $schemaTool = new \Doctrine\ORM\Tools\SchemaTool($em);
                        $classes = $em->getMetadataFactory()->getAllMetadata();
                        $schemaTool->createSchema($classes);
                        $em->getConnection()->connect();
                    } catch (\Exception $e) {
                        //do nothing because the exception is often scheme already exists
                    }
                } else {
                    $this->flashMessenger()->setNamespace('error')->addMessage('[DB] Error :-( Please supply everything');
                }

                $username = $this->getRequest()->getPost()->uusername;
                $password = $this->getRequest()->getPost()->upassword;
                $email = $this->getRequest()->getPost()->email;
                $firstname = $this->getRequest()->getPost()->firstname;
                $lastname = $this->getRequest()->getPost()->lastname;

                if ($username != '' && $password != '' && $email != '' && $firstname != '' && $lastname != '') {
                    $this->createUser($username, $firstname, $lastname, $email, $password);
                }

                return $this->redirect()->toRoute('home');
            } else {
                if ($local_config) {
                    $config = $this->getServiceLocator()->get('config');
                    $title = $config['settings']['title'];
                    $desc = $config['settings']['desc'];
                    $keywords = $config['settings']['keywords'];
                    $lang = $config['settings']['language'];
                } else {
                    $title = '';
                    $desc = '';
                    $keywords = '';
                    $lang = '';
                }

                if ($db_c) {
                    $config = $this->getServiceLocator()->get('config');
                    $host = $config['doctrine']['connection']['orm_default']['params']['host'];
                    $port = $config['doctrine']['connection']['orm_default']['params']['port'];
                    $dbname = $config['doctrine']['connection']['orm_default']['params']['dbname'];
                    $dbuser = $config['doctrine']['connection']['orm_default']['params']['user'];
                    $dbpassword = $config['doctrine']['connection']['orm_default']['params']['password'];
                } else {
                    $host = '';
                    $port = '';
                    $dbname = '';
                    $dbuser = '';
                    $dbpassword = '';
                }
            }

            return new ViewModel(array(
                'locked' => false,
                'version_core' => file_get_contents("VERSION"),
                'version' => file_get_contents("VERSION_API"),
                'lang' => $language,
                'db_i' => $db_conn,
                'local_config' => $local_config,
                'data' => $data_w,
                'avatars' => $avatars_w,
                'files' => $files_w,
                'global' => $local_config,
                'database' => $db_c,
                'title_v' => $title,
                'desc_v' => $desc,
                'keywords_v' => $keywords,
                'host' => $host,
                'port' => $port,
                'dbname' => $dbname,
                'dbuser' => $dbuser,
                'dbpassword' => $dbpassword,
                'lang' => $lang,
            ));
        }
    }

    public function createUser($username, $firstname, $lastname, $email, $password)
    {
        try {
            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            //create admin permission
            $validator = new \DoctrineModule\Validator\NoObjectExists(array(
                    // object repository to lookup
                    'object_repository' => $em->getRepository('\Application\Entity\Permission'),

                    // fields to match
                    'fields' => array('name'),
            ));

            if ($validator->isValid(array('name' => 'Administrator'))) {
                $permission = new \Application\Entity\Permission();
                $permission->setName('Administrator');
                $permission->setCAN_LOGIN(true);
                $permission->setACCESS_FROM_STUDENT_LEAD(false);
                $permission->setACCESS_FROM_COURS_LEAD(false);
                $permission->setCAN_ACCESS_ADMIN_AREA(true);
                $permission->setCAN_ACCESS_MOD_AREA(false);
                $permission->setCAN_ACCESS_TEACHER_AREA(false);
                $permission->setCAN_ACCESS_STUDENT_AREA(false);
                $permission->setCAN_UPDATE_PROFILE_PRIVATE(false);
                $permission->setCAN_UPDATE_PROFILE_INTERNAL(false);
                $permission->setCAN_UPDATE_PROFILE_PUBLIC(false);
                $permission->setCAN_DELETE_USER_PRIVATE(false);
                $permission->setCAN_DELETE_USER_INTERNAL(false);
                $permission->setCAN_DELETE_USER_PUBLIC(false);
                $permission->setCAN_UPLOAD_DOCUMENT(false);
                $permission->setCAN_VIEW_DOCUMENT_PRIVATE(false);
                $permission->setCAN_VIEW_DOCUMENT_INTERNAL(false);
                $permission->setCAN_VIEW_DOCUMENT_PUBLIC(false);
                $permission->setCAN_EDIT_DOCUMENT_PRIVATE(false);
                $permission->setCAN_EDIT_DOCUMENT_INTERNAL(false);
                $permission->setCAN_EDIT_DOCUMENT_PUBLIC(false);
                $permission->setCAN_DELETE_DOCUMENT_PRIVATE(false);
                $permission->setCAN_DELETE_DOCUMENT_INTERNAL(false);
                $permission->setCAN_DELETE_DOCUMENT_PUBLIC(false);
                $permission->setCAN_COMMENT_DOCUMENT_PRIVATE(false);
                $permission->setCAN_COMMENT_DOCUMENT_INTERNAL(false);
                $permission->setCAN_COMMENT_DOCUMENT_PUBLIC(false);
                $permission->setCAN_CREATE_DOCUMENT_PRIVATE(false);
                $permission->setCAN_CREATE_DOCUMENT_INTERNAL(false);
                $permission->setCAN_CREATE_DOCUMENT_PUBLIC(false);
                $permission->setCAN_CREATE_DOCUMENT_TEXT(false);
                $permission->setCAN_CREATE_DOCUMENT_BWL(false);
                $em->persist($permission);
                $em->flush();
            }

              //get permission entity
            $permission_e = $em->getRepository('\Application\Entity\Permission')->findBy(array('name' => 'Administrator'));

            $bcrypt = new Bcrypt();
            $password_hash = $bcrypt->create($password);

            //create admin user with provided details
            $newUser = new \Application\Entity\User();
            $newUser->setUsername(utf8_decode($username));
            $newUser->setFirstName(utf8_decode($firstname));
            $newUser->setLastName(utf8_decode($lastname));
            $newUser->setEmail($email);
            $newUser->setPermission($permission_e[0]);
            $newUser->setPassword($password_hash);
            $newUser->setAvatar('default');
            $em->persist($newUser);
            $em->flush();
        } catch (\Exception $e) {
            var_dump($e);
        }
    }
}
