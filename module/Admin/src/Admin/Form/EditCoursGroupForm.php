<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class EditCoursGroupForm extends Form
{
    public function __construct($placeholder, $student_array)
    {
        parent::__construct('editcoursgroupform');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type' => 'text',
                'id' => 'name',
                'style' => 'width:100%;',
                'value' => $placeholder,
            ),
        ));

        $select_student_lead = new Element\Select('select');
        $select_student_lead->setValueOptions($this->utf8_converter($student_array));
        $select_student_lead->setAttributes(array('style' => 'width:100%;', 'class' => 'form-controll'));
        $this->add($select_student_lead);

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Edit',
                'class' => 'btn btn-default btn-block',
            ),
        ));
    }

    function utf8_converter($array)
    {
        array_walk_recursive($array, function(&$item, $key){
            if(!mb_detect_encoding($item, 'utf-8', true)){
                $item = utf8_encode($item);
            }
        });

        return $array;
    }
}
