<?php

namespace Application\Controller;

use Application\Repository\DocumentRepository;
use Application\ViewHelper\PaginatorHelper;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class PublicDocumentOverviewController extends AbstractActionController
{
    public function indexAction()
    {
        $page = $this->params()->fromRoute('page', 1);
        $limit = 10;
        $offset = ($page == 0) ? 0 : ($page - 1) * $limit;
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $pagedRepository = new DocumentRepository($em);
        $pagedContent = $pagedRepository->getPaginator($offset, $limit);


        return new ViewModel(array(
            "pagedContent" => $pagedContent,
            "page" => $page,
        ));
    }
}
