<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class AddSubjectForm extends Form
{
    public function __construct($icon_array, $school_array)
    {
        parent::__construct('addsubjectform');
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
        $select->setValueOptions($icon_array);
        $select->setAttributes(array('style' => 'width:100%;', 'class' => 'form-controll'));
        $this->add($select);

        $select_school = new Element\Select('select_school');
        $select_school->setValueOptions($school_array);
        $select_school->setAttributes(array('style' => 'width:100%;', 'class' => 'form-controll'));
        $this->add($select_school);

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
