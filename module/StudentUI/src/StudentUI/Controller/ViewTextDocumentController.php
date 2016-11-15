<?php
namespace StudentUI\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Decoda\Filter\DefaultFilter;
use Decoda\Filter\ImageFilter;
use Decoda\Filter\ListFilter;
use Decoda\Filter\QuoteFilter;
use Decoda\Decoda;

class ViewTextDocumentController extends AbstractActionController
{

    public function indexAction()
    {
        if ($this->getServiceLocator()->get('StudentUIPermissionService')->hasRightToAccessStudentUI($this)) {
            $this->layout('layout/studentui.phtml');
            $login = new Container('studentui_login');

            if (!isset($login->UserID)) {
                return $this->redirect('login');
                die();
            }

            $text = null;
            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            $user = $em->getRepository('\Application\Entity\User')->findOneById($login->UserID);

            $file_id = $this->getEvent()->getRouteMatch()->getParam('id');

            $document = $em->getRepository('\Application\Entity\Document')->findOneById($file_id);

            if($document == null) {
                $content = null;
                $document = null;
            } else {
                if($document->getOwner()->getId() != $user->getId()) {
                    return $this->getServiceLocator()->get('StudentUIPermissionService')->performNoPermission($this);
                }

                //format
                $content = new Decoda($document->getContent());
                $content->addFilter(new DefaultFilter());
                $content->addFilter(new ListFilter());
                $content->addFilter(new QuoteFilter());
                $content->addFilter(new ImageFilter());
                $content = $content->parse();
            }

            return new ViewModel(
                array(
                    "text" => $text,
                    "content" => $content,
                    "document" => $document
                )
            );

        } else {
            return $this->getServiceLocator()->get('StudentUIPermissionService')->performNoPermission($this);
        }
    }

}