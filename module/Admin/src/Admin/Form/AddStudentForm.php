<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class AddStudentForm extends Form
{
    public function __construct($cours_array)
    {
        parent::__construct('addstudentform');
        $this->setAttribute('method', 'post');

        $select = new Element\Select('select');
        $select->setValueOptions($cours_array);
        $select->setAttributes(array('style' => 'width:100%;', 'class' => 'form-controll'));
        $this->add($select);

        $this->add(array(
        'name' => 'submit',
        'attributes' => array(
            'type' => 'submit',
            'value' => 'Add',
            'class' => 'btn btn-default btn-block',
        ),
    ));
    }
}
