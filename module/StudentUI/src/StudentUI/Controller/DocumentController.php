<?php
namespace StudentUI\Controller;

use StudentUI\Repository\DocumentRepository;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class DocumentController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('StudentUIPermissionService')->hasRightToAccessStudentUI($this)) {
            $login = new Container('studentui_login');
            if (!isset($login->UserID)) {
                return $this->redirect('login');
                die();
            }

            $this->layout('layout/studentui.phtml');
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
        } else {
            return $this->getServiceLocator()->get('StudentUIPermissionService')->performNoPermission($this);
        }
    } 
}
