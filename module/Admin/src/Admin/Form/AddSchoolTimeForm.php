<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class AddSchoolTimeForm extends Form
{
    public function __construct($school_array)
    {
        parent::__construct('addschooltimeform');
        $this->setAttribute('method', 'post');

        $this->add(array(
          'name' => 'name',
          'attributes' => array(
                'type' => 'text',
                'id' => 'name',
                'style' => 'width:100%;',
          ),
        ));

        $starttime = new Element\Time('start');
        $starttime
            ->setLabel('Time')
            ->setAttributes(array(
                'min' => '00:00:00',
                'max' => '23:59:59',
                'name' => 'start',
                'step' => '60', // seconds; default step interval is 60 seconds
        ));
        $this->add($starttime);

        $endtime = new Element\Time('end');
        $endtime
            ->setLabel('Time')
            ->setAttributes(array(
                'min' => '00:00:00',
                'name' => 'end',
                'max' => '23:59:59',
                'step' => '60', // seconds; default step interval is 60 seconds
        ));
        $this->add($endtime);

        $select = new Element\Select('select');
        $select->setValueOptions($school_array);
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
