<?php
namespace StudentUI\Controller;

use Application\Entity\PublicDocument;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;


class ShareDocumentController extends AbstractActionController
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

            //get state
            $public_documents = $document->getPublic();

            if($public_documents != null) {
                $state = true;
            } else {
                $state = false;
            }


            if ($this->getRequest()->isPost()) {
                $this->shareDocument($em, $user, $document, $state);
            }

            return new ViewModel(
                array(
                    "document" => $document,
                    "public" => (bool)$document->getPublic(),
                    "state" => $state
                )
            );

        } else {
            return $this->getServiceLocator()->get('StudentUIPermissionService')->performNoPermission($this);
        }

    }

    public function shareDocument($em, $user, $document, $state) {
        $state_db = $title = $this->getRequest()->getPost()["public"];


        if($state_db == null) {
            if($state) {
                $publicdocument = $document->getPublic();
                $em->remove($publicdocument);
                $em->flush();
            }
        } else {
            if(!$state) {
                //list document public
                $publicdocument = new PublicDocument();
                $publicdocument->setDocument($document);
                $em->persist($publicdocument);
                $em->flush();
            }
        }

    }

}