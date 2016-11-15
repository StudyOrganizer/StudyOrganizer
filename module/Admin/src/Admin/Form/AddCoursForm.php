<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class AddCoursForm extends Form
{
    public function __construct($school_array, $courses_group_array, $subject_array)
    {
        parent::__construct('addcoursform');
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
        $select->setValueOptions($school_array);
        $select->setAttributes(array('style' => 'width:100%;', 'class' => 'form-controll', "id" => "school_select"));
        $this->add($select);

        $select_courses = new Element\Select('select_courses');
        $select_courses->setValueOptions($courses_group_array);
        $select_courses->setAttributes(array('style' => 'width:100%;', 'class' => 'form-controll', "id" => "cours_group_select","multiple" => "multiple"));
        $this->add($select_courses);

        $select_subjects = new Element\Select('select_subjects');
        $select_subjects->setValueOptions($subject_array);
        $select_subjects->setAttributes(array('style' => 'width:100%;', 'class' => 'form-controll', "id" => "subject_select","multiple" => "multiple"));
        $this->add($select_subjects);

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
