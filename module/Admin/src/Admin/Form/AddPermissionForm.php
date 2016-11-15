<?php

namespace Admin\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class AddPermissionForm extends Form
{
    public function __construct()
    {
        parent::__construct('addpermissionform');
        $this->setAttribute('method', 'post');

        $this->add(array(
          'name' => 'name',
          'attributes' => array(
                'type' => 'text',
                'id' => 'name',
                'style' => 'width:100%;',
          ),
        ));

        //CAN LOGIN
        $canLogin = new Element\Checkbox('CAN_LOGIN');
        $canLogin->setLabel('Permission: CAN_LOGIN');
        $canLogin->setCheckedValue('true');
        $canLogin->setUseHiddenElement(false);
        $canLogin->setUncheckedValue('false');
        $this->add($canLogin);

        //CAN ACCESS ADMIN AREA
        $CAN_ACCESS_ADMIN_AREA = new Element\Checkbox('CAN_ACCESS_ADMIN_AREA');
        $CAN_ACCESS_ADMIN_AREA->setLabel('Permission: CAN_ACCESS_ADMIN_AREA');
        $CAN_ACCESS_ADMIN_AREA->setCheckedValue('true');
        $CAN_ACCESS_ADMIN_AREA->setUseHiddenElement(false);
        $CAN_ACCESS_ADMIN_AREA->setUncheckedValue('false');
        $this->add($CAN_ACCESS_ADMIN_AREA);

        //ACCESS FROM STUDENT LEAD
        $ACCESS_FROM_STUDENT_LEAD = new Element\Checkbox('ACCESS_FROM_STUDENT_LEAD');
        $ACCESS_FROM_STUDENT_LEAD->setLabel('Option: ACCESS_FROM_STUDENT_LEAD');
        $ACCESS_FROM_STUDENT_LEAD->setCheckedValue('true');
        $ACCESS_FROM_STUDENT_LEAD->setUseHiddenElement(false);
        $ACCESS_FROM_STUDENT_LEAD->setUncheckedValue('false');
        $this->add($ACCESS_FROM_STUDENT_LEAD);

        //ACCESS FROM COURS LEAD
        $ACCESS_FROM_COURS_LEAD = new Element\Checkbox('ACCESS_FROM_COURS_LEAD');
        $ACCESS_FROM_COURS_LEAD->setLabel('Option: ACCESS_FROM_COURS_LEAD');
        $ACCESS_FROM_COURS_LEAD->setCheckedValue('true');
        $ACCESS_FROM_COURS_LEAD->setUseHiddenElement(false);
        $ACCESS_FROM_COURS_LEAD->setUncheckedValue('false');
        $this->add($ACCESS_FROM_COURS_LEAD);

        //CAN ACCESS ADMIN AREA
        $CAN_ACCESS_ADMIN_AREA = new Element\Checkbox('CAN_ACCESS_ADMIN_AREA');
        $CAN_ACCESS_ADMIN_AREA->setLabel('Permission: CAN_ACCESS_ADMIN_AREA');
        $CAN_ACCESS_ADMIN_AREA->setCheckedValue('true');
        $CAN_ACCESS_ADMIN_AREA->setUncheckedValue('false');
        $CAN_ACCESS_ADMIN_AREA->setUseHiddenElement(false);
        $this->add($CAN_ACCESS_ADMIN_AREA);

        //CAN_ACCESS_MOD_AREA
        $CAN_ACCESS_MOD_AREA = new Element\Checkbox('CAN_ACCESS_MOD_AREA');
        $CAN_ACCESS_MOD_AREA->setLabel('Permission: CAN_ACCESS_MOD_AREA');
        $CAN_ACCESS_MOD_AREA->setCheckedValue('true');
        $CAN_ACCESS_MOD_AREA->setUncheckedValue('false');
        $CAN_ACCESS_MOD_AREA->setUseHiddenElement(false);
        $this->add($CAN_ACCESS_MOD_AREA);

        //CAN_ACCESS_TEACHER_AREA
        $CAN_ACCESS_TEACHER_AREA = new Element\Checkbox('CAN_ACCESS_TEACHER_AREA');
        $CAN_ACCESS_TEACHER_AREA->setLabel('Permission: CAN_ACCESS_TEACHER_AREA');
        $CAN_ACCESS_TEACHER_AREA->setCheckedValue('true');
        $CAN_ACCESS_TEACHER_AREA->setUncheckedValue('false');
        $CAN_ACCESS_TEACHER_AREA->setUseHiddenElement(false);
        $this->add($CAN_ACCESS_TEACHER_AREA);

        //CAN_ACCESS_STUDENT_AREA
        $CAN_ACCESS_STUDENT_AREA = new Element\Checkbox('CAN_ACCESS_STUDENT_AREA');
        $CAN_ACCESS_STUDENT_AREA->setLabel('Permission: CAN_ACCESS_STUDENT_AREA');
        $CAN_ACCESS_STUDENT_AREA->setCheckedValue('true');
        $CAN_ACCESS_STUDENT_AREA->setUncheckedValue('false');
        $CAN_ACCESS_STUDENT_AREA->setUseHiddenElement(false);
        $this->add($CAN_ACCESS_STUDENT_AREA);

        //CAN_UPDATE_PROFILE_PRIVATE
        $CAN_UPDATE_PROFILE_PRIVATE = new Element\Checkbox('CAN_UPDATE_PROFILE_PRIVATE');
        $CAN_UPDATE_PROFILE_PRIVATE->setLabel('Permission: CAN_UPDATE_PROFILE_PRIVATE');
        $CAN_UPDATE_PROFILE_PRIVATE->setCheckedValue('true');
        $CAN_UPDATE_PROFILE_PRIVATE->setUncheckedValue('false');
        $CAN_UPDATE_PROFILE_PRIVATE->setUseHiddenElement(false);
        $this->add($CAN_UPDATE_PROFILE_PRIVATE);

        //CAN_UPDATE_PROFILE_INTERNAL
        $CAN_UPDATE_PROFILE_INTERNAL = new Element\Checkbox('CAN_UPDATE_PROFILE_INTERNAL');
        $CAN_UPDATE_PROFILE_INTERNAL->setLabel('Permission: CAN_UPDATE_PROFILE_INTERNAL');
        $CAN_UPDATE_PROFILE_INTERNAL->setCheckedValue('true');
        $CAN_UPDATE_PROFILE_INTERNAL->setUncheckedValue('false');
        $CAN_UPDATE_PROFILE_INTERNAL->setUseHiddenElement(false);
        $this->add($CAN_UPDATE_PROFILE_INTERNAL);

        //CAN_UPDATE_PROFILE_PUBLIC
        $CAN_UPDATE_PROFILE_PUBLIC = new Element\Checkbox('CAN_UPDATE_PROFILE_PUBLIC');
        $CAN_UPDATE_PROFILE_PUBLIC->setLabel('Permission: CAN_UPDATE_PROFILE_PUBLIC');
        $CAN_UPDATE_PROFILE_PUBLIC->setCheckedValue('true');
        $CAN_UPDATE_PROFILE_PUBLIC->setUncheckedValue('false');
        $CAN_UPDATE_PROFILE_PUBLIC->setUseHiddenElement(false);
        $this->add($CAN_UPDATE_PROFILE_PUBLIC);

        //CAN_DELETE_USER_PRIVATE
        $CAN_DELETE_USER_PRIVATE = new Element\Checkbox('CAN_DELETE_USER_PRIVATE');
        $CAN_DELETE_USER_PRIVATE->setLabel('Permission: CAN_DELETE_USER_PRIVATE');
        $CAN_DELETE_USER_PRIVATE->setCheckedValue('true');
        $CAN_DELETE_USER_PRIVATE->setUncheckedValue('false');
        $CAN_DELETE_USER_PRIVATE->setUseHiddenElement(false);
        $this->add($CAN_DELETE_USER_PRIVATE);

        //CAN_DELETE_USER_INTERNAL
        $CAN_DELETE_USER_INTERNAL = new Element\Checkbox('CAN_DELETE_USER_INTERNAL');
        $CAN_DELETE_USER_INTERNAL->setLabel('Permission: CAN_DELETE_USER_INTERNAL');
        $CAN_DELETE_USER_INTERNAL->setCheckedValue('true');
        $CAN_DELETE_USER_INTERNAL->setUncheckedValue('false');
        $CAN_DELETE_USER_INTERNAL->setUseHiddenElement(false);
        $this->add($CAN_DELETE_USER_INTERNAL);

        //CAN_DELETE_USER_PUBLIC
        $CAN_DELETE_USER_PUBLIC = new Element\Checkbox('CAN_DELETE_USER_PUBLIC');
        $CAN_DELETE_USER_PUBLIC->setLabel('Permission: CAN_DELETE_USER_PUBLIC');
        $CAN_DELETE_USER_PUBLIC->setCheckedValue('true');
        $CAN_DELETE_USER_PUBLIC->setUncheckedValue('false');
        $CAN_DELETE_USER_PUBLIC->setUseHiddenElement(false);
        $this->add($CAN_DELETE_USER_PUBLIC);

        //CAN_UPLOAD_DOCUMENT
        $CAN_UPLOAD_DOCUMENT = new Element\Checkbox('CAN_UPLOAD_DOCUMENT');
        $CAN_UPLOAD_DOCUMENT->setLabel('Permission: CAN_UPLOAD_DOCUMENT');
        $CAN_UPLOAD_DOCUMENT->setCheckedValue('true');
        $CAN_UPLOAD_DOCUMENT->setUncheckedValue('false');
        $CAN_UPLOAD_DOCUMENT->setUseHiddenElement(false);
        $this->add($CAN_UPLOAD_DOCUMENT);

        //CAN_VIEW_DOCUMENT_PRIVATE
        $CAN_VIEW_DOCUMENT_PRIVATE = new Element\Checkbox('CAN_VIEW_DOCUMENT_PRIVATE');
        $CAN_VIEW_DOCUMENT_PRIVATE->setLabel('Permission: CAN_VIEW_DOCUMENT_PRIVATE');
        $CAN_VIEW_DOCUMENT_PRIVATE->setCheckedValue('true');
        $CAN_VIEW_DOCUMENT_PRIVATE->setUncheckedValue('false');
        $CAN_VIEW_DOCUMENT_PRIVATE->setUseHiddenElement(false);
        $this->add($CAN_VIEW_DOCUMENT_PRIVATE);

        //CAN_VIEW_DOCUMENT_INTERNAL
        $CAN_VIEW_DOCUMENT_INTERNAL = new Element\Checkbox('CAN_VIEW_DOCUMENT_INTERNAL');
        $CAN_VIEW_DOCUMENT_INTERNAL->setLabel('Permission: CAN_VIEW_DOCUMENT_INTERNAL');
        $CAN_VIEW_DOCUMENT_INTERNAL->setCheckedValue('true');
        $CAN_VIEW_DOCUMENT_INTERNAL->setUncheckedValue('false');
        $CAN_VIEW_DOCUMENT_INTERNAL->setUseHiddenElement(false);
        $this->add($CAN_VIEW_DOCUMENT_INTERNAL);

        //CAN_VIEW_DOCUMENT_PUBLIC
        $CAN_VIEW_DOCUMENT_PUBLIC = new Element\Checkbox('CAN_VIEW_DOCUMENT_PUBLIC');
        $CAN_VIEW_DOCUMENT_PUBLIC->setLabel('Permission: CAN_VIEW_DOCUMENT_PUBLIC');
        $CAN_VIEW_DOCUMENT_PUBLIC->setCheckedValue('true');
        $CAN_VIEW_DOCUMENT_PUBLIC->setUncheckedValue('false');
        $CAN_VIEW_DOCUMENT_PUBLIC->setUseHiddenElement(false);
        $this->add($CAN_VIEW_DOCUMENT_PUBLIC);

        //CAN_EDIT_DOCUMENT_PRIVATE
        $CAN_EDIT_DOCUMENT_PRIVATE = new Element\Checkbox('CAN_EDIT_DOCUMENT_PRIVATE');
        $CAN_EDIT_DOCUMENT_PRIVATE->setLabel('Permission: CAN_EDIT_DOCUMENT_PRIVATE');
        $CAN_EDIT_DOCUMENT_PRIVATE->setCheckedValue('true');
        $CAN_EDIT_DOCUMENT_PRIVATE->setUncheckedValue('false');
        $CAN_EDIT_DOCUMENT_PRIVATE->setUseHiddenElement(false);
        $this->add($CAN_EDIT_DOCUMENT_PRIVATE);

        //CAN_EDIT_DOCUMENT_INTERNAL
        $CAN_EDIT_DOCUMENT_INTERNAL = new Element\Checkbox('CAN_EDIT_DOCUMENT_INTERNAL');
        $CAN_EDIT_DOCUMENT_INTERNAL->setLabel('Permission: CAN_EDIT_DOCUMENT_INTERNAL');
        $CAN_EDIT_DOCUMENT_INTERNAL->setCheckedValue('true');
        $CAN_EDIT_DOCUMENT_INTERNAL->setUncheckedValue('false');
        $CAN_EDIT_DOCUMENT_INTERNAL->setUseHiddenElement(false);
        $this->add($CAN_EDIT_DOCUMENT_INTERNAL);

        //CAN_EDIT_DOCUMENT_PUBLIC
        $CAN_EDIT_DOCUMENT_PUBLIC = new Element\Checkbox('CAN_EDIT_DOCUMENT_PUBLIC');
        $CAN_EDIT_DOCUMENT_PUBLIC->setLabel('Permission: CAN_EDIT_DOCUMENT_PUBLIC');
        $CAN_EDIT_DOCUMENT_PUBLIC->setCheckedValue('true');
        $CAN_EDIT_DOCUMENT_PUBLIC->setUncheckedValue('false');
        $CAN_EDIT_DOCUMENT_PUBLIC->setUseHiddenElement(false);
        $this->add($CAN_EDIT_DOCUMENT_PUBLIC);

        //CAN_DELETE_DOCUMENT_PRIVATE
        $CAN_DELETE_DOCUMENT_PRIVATE = new Element\Checkbox('CAN_DELETE_DOCUMENT_PRIVATE');
        $CAN_DELETE_DOCUMENT_PRIVATE->setLabel('Permission: CAN_DELETE_DOCUMENT_PRIVATE');
        $CAN_DELETE_DOCUMENT_PRIVATE->setCheckedValue('true');
        $CAN_DELETE_DOCUMENT_PRIVATE->setUncheckedValue('false');
        $CAN_DELETE_DOCUMENT_PRIVATE->setUseHiddenElement(false);
        $this->add($CAN_DELETE_DOCUMENT_PRIVATE);

        //CAN_DELETE_DOCUMENT_INTERNAL
        $CAN_DELETE_DOCUMENT_INTERNAL = new Element\Checkbox('CAN_DELETE_DOCUMENT_INTERNAL');
        $CAN_DELETE_DOCUMENT_INTERNAL->setLabel('Permission: CAN_DELETE_DOCUMENT_INTERNAL');
        $CAN_DELETE_DOCUMENT_INTERNAL->setCheckedValue('true');
        $CAN_DELETE_DOCUMENT_INTERNAL->setUncheckedValue('false');
        $CAN_DELETE_DOCUMENT_INTERNAL->setUseHiddenElement(false);
        $this->add($CAN_DELETE_DOCUMENT_INTERNAL);

        //CAN_DELETE_DOCUMENTE_PUBLIC
        $CAN_DELETE_DOCUMENT_PUBLIC = new Element\Checkbox('CAN_DELETE_DOCUMENT_PUBLIC');
        $CAN_DELETE_DOCUMENT_PUBLIC->setLabel('Permission: CAN_DELETE_DOCUMENT_PUBLIC');
        $CAN_DELETE_DOCUMENT_PUBLIC->setCheckedValue('true');
        $CAN_DELETE_DOCUMENT_PUBLIC->setUseHiddenElement(false);
        $CAN_DELETE_DOCUMENT_PUBLIC->setUncheckedValue('false');
        $this->add($CAN_DELETE_DOCUMENT_PUBLIC);

        //CAN_COMMENT_DOCUMENT_PRIVATE
        $CAN_COMMENT_DOCUMENT_PRIVATE = new Element\Checkbox('CAN_COMMENT_DOCUMENT_PRIVATE');
        $CAN_COMMENT_DOCUMENT_PRIVATE->setLabel('Permission: CAN_COMMENT_DOCUMENT_PRIVATE');
        $CAN_COMMENT_DOCUMENT_PRIVATE->setCheckedValue('true');
        $CAN_COMMENT_DOCUMENT_PRIVATE->setUncheckedValue('false');
        $CAN_COMMENT_DOCUMENT_PRIVATE->setUseHiddenElement(false);
        $this->add($CAN_COMMENT_DOCUMENT_PRIVATE);

        //CAN_COMMENT_DOCUMENT_INTERNAL
        $CAN_COMMENT_DOCUMENT_INTERNAL = new Element\Checkbox('CAN_COMMENT_DOCUMENT_INTERNAL');
        $CAN_COMMENT_DOCUMENT_INTERNAL->setLabel('Permission: CAN_COMMENT_DOCUMENT_INTERNAL');
        $CAN_COMMENT_DOCUMENT_INTERNAL->setCheckedValue('true');
        $CAN_COMMENT_DOCUMENT_INTERNAL->setUncheckedValue('false');
        $CAN_COMMENT_DOCUMENT_INTERNAL->setUseHiddenElement(false);
        $this->add($CAN_COMMENT_DOCUMENT_INTERNAL);

        //CAN_COMMENT_DOCUMENT_PUBLIC
        $CAN_COMMENT_DOCUMENT_PUBLIC = new Element\Checkbox('CAN_COMMENT_DOCUMENT_PUBLIC');
        $CAN_COMMENT_DOCUMENT_PUBLIC->setLabel('Permission: CAN_COMMENT_DOCUMENT_PUBLIC');
        $CAN_COMMENT_DOCUMENT_PUBLIC->setCheckedValue('true');
        $CAN_COMMENT_DOCUMENT_PUBLIC->setUncheckedValue('false');
        $CAN_COMMENT_DOCUMENT_PUBLIC->setUseHiddenElement(false);
        $this->add($CAN_COMMENT_DOCUMENT_PUBLIC);

        //CAN_CREATE_DOCUMENT_PRIVATE
        $CAN_CREATE_DOCUMENT_PRIVATE = new Element\Checkbox('CAN_CREATE_DOCUMENT_PRIVATE');
        $CAN_CREATE_DOCUMENT_PRIVATE->setLabel('Permission: CAN_CREATE_DOCUMENT_PRIVATE');
        $CAN_CREATE_DOCUMENT_PRIVATE->setCheckedValue('true');
        $CAN_CREATE_DOCUMENT_PRIVATE->setUncheckedValue('false');
        $CAN_CREATE_DOCUMENT_PRIVATE->setUseHiddenElement(false);
        $this->add($CAN_CREATE_DOCUMENT_PRIVATE);

        //CAN_CREATE_DOCUMENT_INTERNAL
        $CAN_CREATE_DOCUMENT_INTERNAL = new Element\Checkbox('CAN_CREATE_DOCUMENT_INTERNAL');
        $CAN_CREATE_DOCUMENT_INTERNAL->setLabel('Permission: CAN_CREATE_DOCUMENT_INTERNAL');
        $CAN_CREATE_DOCUMENT_INTERNAL->setCheckedValue('true');
        $CAN_CREATE_DOCUMENT_INTERNAL->setUncheckedValue('false');
        $CAN_CREATE_DOCUMENT_INTERNAL->setUseHiddenElement(false);
        $this->add($CAN_CREATE_DOCUMENT_INTERNAL);

        //CAN_CREATE_DOCUMENT_PUBLIC
        $CAN_CREATE_DOCUMENT_PUBLIC = new Element\Checkbox('CAN_CREATE_DOCUMENT_PUBLIC');
        $CAN_CREATE_DOCUMENT_PUBLIC->setLabel('Permission: CAN_CREATE_DOCUMENT_PUBLIC');
        $CAN_CREATE_DOCUMENT_PUBLIC->setCheckedValue('true');
        $CAN_CREATE_DOCUMENT_PUBLIC->setUncheckedValue('false');
        $CAN_CREATE_DOCUMENT_PUBLIC->setUseHiddenElement(false);
        $this->add($CAN_CREATE_DOCUMENT_PUBLIC);

        //CAN_CREATE_DOCUMENT_TEXT
        $CAN_CREATE_DOCUMENT_TEXT = new Element\Checkbox('CAN_CREATE_DOCUMENT_TEXT');
        $CAN_CREATE_DOCUMENT_TEXT->setLabel('Permission: CAN_CREATE_DOCUMENT_TEXT');
        $CAN_CREATE_DOCUMENT_TEXT->setCheckedValue('true');
        $CAN_CREATE_DOCUMENT_TEXT->setUncheckedValue('false');
        $CAN_CREATE_DOCUMENT_TEXT->setUseHiddenElement(false);
        $this->add($CAN_CREATE_DOCUMENT_TEXT);

        //CAN_CREATE_DOCUMENT_BWL
        $CAN_CREATE_DOCUMENT_BWL = new Element\Checkbox('CAN_CREATE_DOCUMENT_BWL');
        $CAN_CREATE_DOCUMENT_BWL->setLabel('Permission: CAN_CREATE_DOCUMENT_BWL');
        $CAN_CREATE_DOCUMENT_BWL->setCheckedValue('true');
        $CAN_CREATE_DOCUMENT_BWL->setUncheckedValue('false');
        $CAN_CREATE_DOCUMENT_BWL->setUseHiddenElement(false);
        $this->add($CAN_CREATE_DOCUMENT_BWL);

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
