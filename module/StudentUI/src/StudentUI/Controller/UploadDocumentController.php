<?php
namespace StudentUI\Controller;

use Application\Entity\Document;
use Application\Entity\DocumentFile;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class UploadDocumentController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('StudentUIPermissionService')->hasRightToAccessStudentUI($this)) {
            $this->layout('layout/studentui.phtml');
            $login = new Container('studentui_login');
            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            $user = $em->getRepository('\Application\Entity\User')->findOneById($login->UserID);

            if (!isset($login->UserID)) {
                return $this->redirect('login');
                die();
            }

            if ($this->getRequest()->isPost()) {
                $this->uploadDocument($em, $user);
            }

            return new ViewModel();
        } else {
            return $this->getServiceLocator()->get('StudentUIPermissionService')->performNoPermission($this);
        }
    }


    public function uploadDocument($em, $user) {
        $request = $this->getRequest();
        $documents = $request->getFiles()->toArray();
        $ds = DIRECTORY_SEPARATOR;

        if($documents["file"]["type"] == "application/pdf") {
            $path = "data/documents/".uniqid().uniqid().mt_rand(999,999).".pdf";
            $document = new Document();
            $document->setTitle($documents["file"]["name"]);
            $document->setContent("this is a pdf file");
            $document->setOwner($user);
            $em->persist($document);
            $em->flush();

            $document_file = new DocumentFile();
            $document_file->setName($documents["file"]["name"]);
            $document_file->setDocument($document);
            $document_file->setFilePath($path);
            $em->persist($document_file);
            $em->flush();


            move_uploaded_file($documents["file"]["tmp_name"],$path);
        }
    }
}
