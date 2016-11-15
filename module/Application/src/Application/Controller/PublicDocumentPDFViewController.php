<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Decoda\Filter\DefaultFilter;
use Decoda\Filter\ImageFilter;
use Decoda\Filter\ListFilter;
use Decoda\Filter\QuoteFilter;
use Decoda\Decoda;

class PublicDocumentPDFViewController extends AbstractActionController
{

    public function indexAction()
    {
         $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $file_id = $this->getEvent()->getRouteMatch()->getParam('id');
        $document = $em->getRepository('\Application\Entity\Document')->findOneById($file_id);

        if($document == null) {
            $content = null;
            $document = null;
        } else {
            header('Content-type: application/pdf');
            readfile($document->getDocumentFile()->getFilePath());
        }

        return new ViewModel(
            array(
                "text" => "huhu",
                "content" => $content,
                "document" => $document
            )
        );
    }

}