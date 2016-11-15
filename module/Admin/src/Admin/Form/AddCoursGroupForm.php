<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class AddCoursGroupForm extends Form
{
    public function __construct($student_array)
    {
        parent::__construct('addschoolform');
        $this->setAttribute('method', 'post');

        $this->add(array(
      'name' => 'name',
      'attributes' => array(
            'type' => 'text',
            'id' => 'name',
            'style' => 'width:100%;',
      ),
    ));

        $select = new Element\Select('select');
        $select->setValueOptions($student_array);
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
