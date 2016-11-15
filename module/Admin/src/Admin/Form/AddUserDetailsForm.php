<?php

namespace Admin\Form;

use Zend\Form\Form;

class AddUserDetailsForm extends Form
{
    public function __construct()
    {
        parent::__construct('adduserdetailsform');
        $this->setAttribute('method', 'post');

        $this->add(array(
        'name' => 'submit',
        'attributes' => array(
            'type' => 'submit',
            'value' => 'Create User',
            'class' => 'btn btn-default btn-block',
        ),
    ));
    }
}
