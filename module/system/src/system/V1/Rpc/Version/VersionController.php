<?php

namespace system\V1\Rpc\Version;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\ViewModel;

class VersionController extends AbstractActionController
{
    public function versionAction()
    {
        return new ViewModel(array(
             'version' => 'r'.exec('git rev-list --count HEAD'),
       ));
    }
}
