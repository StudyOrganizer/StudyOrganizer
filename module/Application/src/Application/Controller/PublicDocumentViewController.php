<?php
namespace Application\Controller;


use Decoda\Decoda;
use Decoda\Filter\DefaultFilter;
use Decoda\Filter\ImageFilter;
use Decoda\Filter\ListFilter;
use Decoda\Filter\QuoteFilter;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PublicDocumentViewController extends AbstractActionController
{

    public function indexAction()
    {
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $id = $this->getEvent()->getRouteMatch()->getParam('id');

        $public = $em->getRepository('\Application\Entity\Document')->findOneBy(array("id" => $id));

        if($public != null) {
            //format
            $content = new Decoda($public->getContent());
            $content->addFilter(new DefaultFilter());
            $content->addFilter(new ListFilter());
            $content->addFilter(new QuoteFilter());
            $content->addFilter(new ImageFilter());
            return new ViewModel(array("content" => $content->parse(), "document" => $public));
        } else {
            return new ViewModel(array("content" => "Not found, Sorry.", "document" => null));
        }
    }

}