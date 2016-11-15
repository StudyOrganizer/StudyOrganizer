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
use Zend\Escaper\Escaper;

class EditTextDocumentController extends AbstractActionController
{

    public function indexAction() {
        if ($this->getServiceLocator()->get('StudentUIPermissionService')->hasRightToAccessStudentUI($this)) {
            $this->layout('layout/studentui.phtml');
            $login = new Container('studentui_login');
            $text = null;
            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            $user = $em->getRepository('\Application\Entity\User')->findOneById($login->UserID);

            $file_id = $this->getEvent()->getRouteMatch()->getParam('id');

            $document = $em->getRepository('\Application\Entity\Document')->findOneById($file_id);

            if($document->getDocumentfile()) {
                $text = false;
            } else {
                $text = true;
            }

            if($document->getOwner()->getId() != $user->getId()) {
                return $this->getServiceLocator()->get('StudentUIPermissionService')->performNoPermission($this);
            }

            if ($this->getRequest()->isPost()) {
                $this->processDocument($em, $user, $document);
            }

            return new ViewModel(
                array(
                    "text" => $text,
                    "content" => $document->getContent(),
                    "document" => $document
                )
            );

        } else {
            return $this->getServiceLocator()->get('StudentUIPermissionService')->performNoPermission($this);
        }
    }

    public function processDocument($em, $user, $document) {
        $titel = $this->getRequest()->getPost()->titel;
        $content = $this->getRequest()->getPost()->content;

        $escaper = new Escaper('utf-8');

        //escape
        $escapedcontent = $escaper->escapeHtml($content);
        if(strlen($titel) > 2 && strlen($titel) < 99 ) {
            $document->setContent($escapedcontent);
            $document->setTitle($titel);
            $em->merge($document);
            $em->flush();
        } else {
            $this->flashMessenger()->setNamespace('error')->addMessage("Please enter a valid titel.");
        }

        return $this->redirect()->toRoute('studentui_document_text_view', array("id" => $document->getId()));
    }

}