<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class AddSchoolForm extends Form
{
    public function __construct($student_array, $teacher_array)
    {
        parent::__construct('addcoursgroupform');
        $this->setAttribute('method', 'post');

        $this->add(array(
      'name' => 'name',
      'attributes' => array(
            'type' => 'text',
            'id' => 'name',
            'style' => 'width:100%;',
      ),
    ));

        $select_student_lead = new Element\Select('select_student_lead');
        $select_student_lead->setValueOptions($student_array);
        $select_student_lead->setAttributes(array('style' => 'width:100%;', 'class' => 'form-controll'));
        $this->add($select_student_lead);

        $select_headmaster = new Element\Select('select_headmaster');
        $select_headmaster->setValueOptions($teacher_array);
        $select_headmaster->setAttributes(array('style' => 'width:100%;', 'class' => 'form-controll'));
        $this->add($select_headmaster);

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
