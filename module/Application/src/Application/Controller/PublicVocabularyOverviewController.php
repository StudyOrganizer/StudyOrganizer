<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class PublicVocabularyOverviewController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}
