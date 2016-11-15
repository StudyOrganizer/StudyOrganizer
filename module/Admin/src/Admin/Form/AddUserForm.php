<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class AddUserForm extends Form
{
    public function __construct($typ_array, $permission_array)
    {
        parent::__construct('adduserform');
        $this->setAttribute('method', 'post');

        $this->add(array(
          'name' => 'username',
          'attributes' => array(
                'type' => 'text',
                'id' => 'username',
                'style' => 'width:100%;',
          ),
        ));

        $this->add(array(
          'name' => 'firstname',
          'attributes' => array(
                'type' => 'text',
                'id' => 'firstname',
                'style' => 'width:100%;',
          ),
        ));

        $this->add(array(
          'name' => 'lastname',
          'attributes' => array(
                'type' => 'text',
                'id' => 'lastname',
                'style' => 'width:100%;',
          ),
        ));

        $this->add(array(
          'name' => 'email',
          'attributes' => array(
                'type' => 'email',
                'id' => 'email',
                'style' => 'width:100%;',
          ),
        ));

        $permission_select = new Element\Select('permission_select');
        $permission_select->setValueOptions($permission_array);
        $permission_select->setAttributes(array('style' => 'width:100%;', 'class' => 'form-controll'));
        $this->add($permission_select);

        $select = new Element\Select('typ_select');
        $select->setValueOptions($typ_array);
        $select->setAttributes(array('style' => 'width:100%;', 'class' => 'form-controll'));
        $this->add($select);

        $this->add(array(
        'name' => 'submit',
        'attributes' => array(
            'type' => 'submit',
            'value' => 'Next',
            'class' => 'btn btn-default btn-block',
        ),
    ));
    }
}
