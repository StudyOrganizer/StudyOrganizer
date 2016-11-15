<?php
namespace StudentUI\Controller;

use Decoda\Filter\DefaultFilter;
use Decoda\Filter\ImageFilter;
use Decoda\Filter\ListFilter;
use Decoda\Filter\QuoteFilter;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Decoda\Decoda;

class TestViewController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('StudentUIPermissionService')->hasRightToAccessStudentUI($this)) {
            $this->layout('layout/studentui.phtml');
            $login = new Container('studentui_login');
            $test_id = $this->getEvent()->getRouteMatch()->getParam('id');

            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            $test = $em->getRepository('\Application\Entity\Test')->findOneById($test_id);

            if (!isset($login->UserID)) {
                return $this->redirect('login');
                die();
            }

            if($test == null) {
                $title = "";
                $description = "";
            } else {
                $title = $test->getTitle();
                $description = new Decoda($test->getDescription());
                $description->addFilter(new DefaultFilter());
                $description->addFilter(new ListFilter());
                $description->addFilter(new QuoteFilter());
                $description->addFilter(new ImageFilter());
            }

            return new ViewModel(array(
                "title" => $title,
                "description" => $description->parse(),
                "date" => $test->getExpireDate(),
                "id" => array("id" => $test_id)
            ));
        } else {
            return $this->getServiceLocator()->get('StudentUIPermissionService')->performNoPermission($this);
        }
    }
}
