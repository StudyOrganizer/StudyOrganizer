<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="permissions")
 */
class Permission
{
    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="string", name="name", nullable=false) */
    private $name;

    /** @ORM\Column(type="boolean", name="ACCESS_STUDENT_LEAD", nullable=false) */
    private $ACCESS_FROM_STUDENT_LEAD;

    /** @ORM\Column(type="boolean", name="ACCESS_COURS_LEAD", nullable=false) */
    private $ACCESS_FROM_COURS_LEAD;

    /**
     * General PERMISSIONS.
     */

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_LOGIN", nullable=false) */
    private $CAN_LOGIN;

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_ACCESS_ADMIN_AREA", nullable=false) */
    private $CAN_ACCESS_ADMIN_AREA;

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_ACCESS_MOD_AREA", nullable=false) */
    private $CAN_ACCESS_MOD_AREA;

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_ACCESS_TEACHER_AREA", nullable=false) */
    private $CAN_ACCESS_TEACHER_AREA;

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_ACCESS_STUDENT_AREA", nullable=false) */
    private $CAN_ACCESS_STUDENT_AREA;

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_UPDATE_PROFILE_PRIVATE", nullable=false) */
    private $CAN_UPDATE_PROFILE_PRIVATE;

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_UPDATE_PROFILE_INTERNAL", nullable=false) */
    private $CAN_UPDATE_PROFILE_INTERNAL;

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_UPDATE_PROFILE_PUBLIC", nullable=false) */
    private $CAN_UPDATE_PROFILE_PUBLIC;

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_DELETE_USER_PRIVATE", nullable=false) */
    private $CAN_DELETE_USER_PRIVATE;

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_DELETE_USER_INTERNAL", nullable=false) */
    private $CAN_DELETE_USER_INTERNAL;

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_DELETE_USER_PUBLIC", nullable=false) */
    private $CAN_DELETE_USER_PUBLIC;

    /**
     * PERMISSIONS for Documents.
     */

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_UPLOAD_DOCUMENT", nullable=false) */
    private $CAN_UPLOAD_DOCUMENT;

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_VIEW_DOCUMENT_PRIVATE", nullable=false) */
    private $CAN_VIEW_DOCUMENT_PRIVATE;

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_UPLOAD_DOCUMENT_INTERNAL", nullable=false) */
    private $CAN_VIEW_DOCUMENT_INTERNAL;

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_VIEW_DOCUMENT_PUBLIC", nullable=false) */
    private $CAN_VIEW_DOCUMENT_PUBLIC;

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_EDIT_DOCUMENT_PRIVATE", nullable=false) */
    private $CAN_EDIT_DOCUMENT_PRIVATE;

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_EDIT_DOCUMENT_INTERNAL", nullable=false) */
    private $CAN_EDIT_DOCUMENT_INTERNAL;

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_EDIT_DOCUMENT_PUBLIC", nullable=false) */
    private $CAN_EDIT_DOCUMENT_PUBLIC;

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_DELETE_DOCUMENT_PRIVATE", nullable=false) */
    private $CAN_DELETE_DOCUMENT_PRIVATE;

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_DELETE_DOCUMENT_INTERNAL", nullable=false) */
    private $CAN_DELETE_DOCUMENT_INTERNAL;

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_DELETE_DOCUMENT_PUBLIC", nullable=false) */
    private $CAN_DELETE_DOCUMENT_PUBLIC;

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_COMMENT_DOCUMENT_PRIVATE", nullable=false) */
    private $CAN_COMMENT_DOCUMENT_PRIVATE;

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_COMMENT_DOCUMENT_INTERNAL", nullable=false) */
    private $CAN_COMMENT_DOCUMENT_INTERNAL;

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_COMMENT_DOCUMENT_PUBLIC", nullable=false) */
    private $CAN_COMMENT_DOCUMENT_PUBLIC;

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_CREATE_DOCUMENT_PRIVATE", nullable=false) */
    private $CAN_CREATE_DOCUMENT_PRIVATE;

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_CREATE_DOCUMENT_INTERNAL", nullable=false) */
    private $CAN_CREATE_DOCUMENT_INTERNAL;

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_CREATE_DOCUMENT_PUBLIC", nullable=false) */
    private $CAN_CREATE_DOCUMENT_PUBLIC;

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_CREATE_DOCUMENT_TEXT", nullable=false) */
    private $CAN_CREATE_DOCUMENT_TEXT;

    /** @ORM\Column(type="boolean", name="PERMISSION_CAN_CREATE_DOCUMENT_BWL", nullable=false) */
    private $CAN_CREATE_DOCUMENT_BWL;

    /**
     * Get the value of Id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id.
     *
     * @param mixed id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of Name.
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of Name.
     *
     * @param mixed name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = utf8_encode($name);

        return $this;
    }

    /**
     * Get the value of ACCESS FROM STUDENT LEAD.
     *
     * @return mixed
     */
    public function getACCESS_FROM_STUDENT_LEAD()
    {
        return $this->ACCESS_FROM_STUDENT_LEAD;
    }

    /**
     * Set the value of ACCESS FROM STUDENT LEAD.
     *
     * @param mixed ACCESS_FROM_STUDENT_LEAD
     *
     * @return self
     */
    public function setACCESS_FROM_STUDENT_LEAD($ACCESS_FROM_STUDENT_LEAD)
    {
        $this->ACCESS_FROM_STUDENT_LEAD = $ACCESS_FROM_STUDENT_LEAD;

        return $this;
    }

    /**
     * Get the value of ACCESS FROM COURS LEAD.
     *
     * @return mixed
     */
    public function getACCESS_FROM_COURS_LEAD()
    {
        return $this->ACCESS_FROM_COURS_LEAD;
    }

    /**
     * Set the value of ACCESS FROM COURS LEAD.
     *
     * @param mixed ACCESS_FROM_COURS_LEAD
     *
     * @return self
     */
    public function setACCESS_FROM_COURS_LEAD($ACCESS_FROM_COURS_LEAD)
    {
        $this->ACCESS_FROM_COURS_LEAD = $ACCESS_FROM_COURS_LEAD;

        return $this;
    }

    /**
     * Get the value of General PERMISSIONS.
     *
     * @return mixed
     */
    public function getCAN_LOGIN()
    {
        return $this->CAN_LOGIN;
    }

    /**
     * Set the value of General PERMISSIONS.
     *
     * @param mixed CAN_LOGIN
     *
     * @return self
     */
    public function setCAN_LOGIN($CAN_LOGIN)
    {
        $this->CAN_LOGIN = $CAN_LOGIN;

        return $this;
    }

    /**
     * Get the value of CAN ACCESS ADMIN AREA.
     *
     * @return mixed
     */
    public function getCAN_ACCESS_ADMIN_AREA()
    {
        return $this->CAN_ACCESS_ADMIN_AREA;
    }

    /**
     * Set the value of CAN ACCESS ADMIN AREA.
     *
     * @param mixed CAN_ACCESS_ADMIN_AREA
     *
     * @return self
     */
    public function setCAN_ACCESS_ADMIN_AREA($CAN_ACCESS_ADMIN_AREA)
    {
        $this->CAN_ACCESS_ADMIN_AREA = $CAN_ACCESS_ADMIN_AREA;

        return $this;
    }

    /**
     * Get the value of CAN ACCESS MOD AREA.
     *
     * @return mixed
     */
    public function getCAN_ACCESS_MOD_AREA()
    {
        return $this->CAN_ACCESS_MOD_AREA;
    }

    /**
     * Set the value of CAN ACCESS MOD AREA.
     *
     * @param mixed CAN_ACCESS_MOD_AREA
     *
     * @return self
     */
    public function setCAN_ACCESS_MOD_AREA($CAN_ACCESS_MOD_AREA)
    {
        $this->CAN_ACCESS_MOD_AREA = $CAN_ACCESS_MOD_AREA;

        return $this;
    }

    /**
     * Get the value of CAN ACCESS TEACHER AREA.
     *
     * @return mixed
     */
    public function getCAN_ACCESS_TEACHER_AREA()
    {
        return $this->CAN_ACCESS_TEACHER_AREA;
    }

    /**
     * Set the value of CAN ACCESS TEACHER AREA.
     *
     * @param mixed CAN_ACCESS_TEACHER_AREA
     *
     * @return self
     */
    public function setCAN_ACCESS_TEACHER_AREA($CAN_ACCESS_TEACHER_AREA)
    {
        $this->CAN_ACCESS_TEACHER_AREA = $CAN_ACCESS_TEACHER_AREA;

        return $this;
    }

    /**
     * Get the value of CAN ACCESS STUDENT AREA.
     *
     * @return mixed
     */
    public function getCAN_ACCESS_STUDENT_AREA()
    {
        return $this->CAN_ACCESS_STUDENT_AREA;
    }

    /**
     * Set the value of CAN ACCESS STUDENT AREA.
     *
     * @param mixed CAN_ACCESS_STUDENT_AREA
     *
     * @return self
     */
    public function setCAN_ACCESS_STUDENT_AREA($CAN_ACCESS_STUDENT_AREA)
    {
        $this->CAN_ACCESS_STUDENT_AREA = $CAN_ACCESS_STUDENT_AREA;

        return $this;
    }

    /**
     * Get the value of CAN UPDATE PROFILE PRIVATE.
     *
     * @return mixed
     */
    public function getCAN_UPDATE_PROFILE_PRIVATE()
    {
        return $this->CAN_UPDATE_PROFILE_PRIVATE;
    }

    /**
     * Set the value of CAN UPDATE PROFILE PRIVATE.
     *
     * @param mixed CAN_UPDATE_PROFILE_PRIVATE
     *
     * @return self
     */
    public function setCAN_UPDATE_PROFILE_PRIVATE($CAN_UPDATE_PROFILE_PRIVATE)
    {
        $this->CAN_UPDATE_PROFILE_PRIVATE = $CAN_UPDATE_PROFILE_PRIVATE;

        return $this;
    }

    /**
     * Get the value of CAN UPDATE PROFILE INTERNAL.
     *
     * @return mixed
     */
    public function getCAN_UPDATE_PROFILE_INTERNAL()
    {
        return $this->CAN_UPDATE_PROFILE_INTERNAL;
    }

    /**
     * Set the value of CAN UPDATE PROFILE INTERNAL.
     *
     * @param mixed CAN_UPDATE_PROFILE_INTERNAL
     *
     * @return self
     */
    public function setCAN_UPDATE_PROFILE_INTERNAL($CAN_UPDATE_PROFILE_INTERNAL)
    {
        $this->CAN_UPDATE_PROFILE_INTERNAL = $CAN_UPDATE_PROFILE_INTERNAL;

        return $this;
    }

    /**
     * Get the value of CAN UPDATE PROFILE PUBLIC.
     *
     * @return mixed
     */
    public function getCAN_UPDATE_PROFILE_PUBLIC()
    {
        return $this->CAN_UPDATE_PROFILE_PUBLIC;
    }

    /**
     * Set the value of CAN UPDATE PROFILE PUBLIC.
     *
     * @param mixed CAN_UPDATE_PROFILE_PUBLIC
     *
     * @return self
     */
    public function setCAN_UPDATE_PROFILE_PUBLIC($CAN_UPDATE_PROFILE_PUBLIC)
    {
        $this->CAN_UPDATE_PROFILE_PUBLIC = $CAN_UPDATE_PROFILE_PUBLIC;

        return $this;
    }

    /**
     * Get the value of CAN DELETE USER PRIVATE.
     *
     * @return mixed
     */
    public function getCAN_DELETE_USER_PRIVATE()
    {
        return $this->CAN_DELETE_USER_PRIVATE;
    }

    /**
     * Set the value of CAN DELETE USER PRIVATE.
     *
     * @param mixed CAN_DELETE_USER_PRIVATE
     *
     * @return self
     */
    public function setCAN_DELETE_USER_PRIVATE($CAN_DELETE_USER_PRIVATE)
    {
        $this->CAN_DELETE_USER_PRIVATE = $CAN_DELETE_USER_PRIVATE;

        return $this;
    }

    /**
     * Get the value of CAN DELETE USER INTERNAL.
     *
     * @return mixed
     */
    public function getCAN_DELETE_USER_INTERNAL()
    {
        return $this->CAN_DELETE_USER_INTERNAL;
    }

    /**
     * Set the value of CAN DELETE USER INTERNAL.
     *
     * @param mixed CAN_DELETE_USER_INTERNAL
     *
     * @return self
     */
    public function setCAN_DELETE_USER_INTERNAL($CAN_DELETE_USER_INTERNAL)
    {
        $this->CAN_DELETE_USER_INTERNAL = $CAN_DELETE_USER_INTERNAL;

        return $this;
    }

    /**
     * Get the value of CAN DELETE USER PUBLIC.
     *
     * @return mixed
     */
    public function getCAN_DELETE_USER_PUBLIC()
    {
        return $this->CAN_DELETE_USER_PUBLIC;
    }

    /**
     * Set the value of CAN DELETE USER PUBLIC.
     *
     * @param mixed CAN_DELETE_USER_PUBLIC
     *
     * @return self
     */
    public function setCAN_DELETE_USER_PUBLIC($CAN_DELETE_USER_PUBLIC)
    {
        $this->CAN_DELETE_USER_PUBLIC = $CAN_DELETE_USER_PUBLIC;

        return $this;
    }

    /**
     * Get the value of PERMISSIONS for Documents.
     *
     * @return mixed
     */
    public function getCAN_UPLOAD_DOCUMENT()
    {
        return $this->CAN_UPLOAD_DOCUMENT;
    }

    /**
     * Set the value of PERMISSIONS for Documents.
     *
     * @param mixed CAN_UPLOAD_DOCUMENT
     *
     * @return self
     */
    public function setCAN_UPLOAD_DOCUMENT($CAN_UPLOAD_DOCUMENT)
    {
        $this->CAN_UPLOAD_DOCUMENT = $CAN_UPLOAD_DOCUMENT;

        return $this;
    }

    /**
     * Get the value of CAN VIEW DOCUMENT PRIVATE.
     *
     * @return mixed
     */
    public function getCAN_VIEW_DOCUMENT_PRIVATE()
    {
        return $this->CAN_VIEW_DOCUMENT_PRIVATE;
    }

    /**
     * Set the value of CAN VIEW DOCUMENT PRIVATE.
     *
     * @param mixed CAN_VIEW_DOCUMENT_PRIVATE
     *
     * @return self
     */
    public function setCAN_VIEW_DOCUMENT_PRIVATE($CAN_VIEW_DOCUMENT_PRIVATE)
    {
        $this->CAN_VIEW_DOCUMENT_PRIVATE = $CAN_VIEW_DOCUMENT_PRIVATE;

        return $this;
    }

    /**
     * Get the value of CAN VIEW DOCUMENT INTERNAL.
     *
     * @return mixed
     */
    public function getCAN_VIEW_DOCUMENT_INTERNAL()
    {
        return $this->CAN_VIEW_DOCUMENT_INTERNAL;
    }

    /**
     * Set the value of CAN VIEW DOCUMENT INTERNAL.
     *
     * @param mixed CAN_VIEW_DOCUMENT_INTERNAL
     *
     * @return self
     */
    public function setCAN_VIEW_DOCUMENT_INTERNAL($CAN_VIEW_DOCUMENT_INTERNAL)
    {
        $this->CAN_VIEW_DOCUMENT_INTERNAL = $CAN_VIEW_DOCUMENT_INTERNAL;

        return $this;
    }

    /**
     * Get the value of CAN VIEW DOCUMENT PUBLIC.
     *
     * @return mixed
     */
    public function getCAN_VIEW_DOCUMENT_PUBLIC()
    {
        return $this->CAN_VIEW_DOCUMENT_PUBLIC;
    }

    /**
     * Set the value of CAN VIEW DOCUMENT PUBLIC.
     *
     * @param mixed CAN_VIEW_DOCUMENT_PUBLIC
     *
     * @return self
     */
    public function setCAN_VIEW_DOCUMENT_PUBLIC($CAN_VIEW_DOCUMENT_PUBLIC)
    {
        $this->CAN_VIEW_DOCUMENT_PUBLIC = $CAN_VIEW_DOCUMENT_PUBLIC;

        return $this;
    }

    /**
     * Get the value of CAN EDIT DOCUMENT PRIVATE.
     *
     * @return mixed
     */
    public function getCAN_EDIT_DOCUMENT_PRIVATE()
    {
        return $this->CAN_EDIT_DOCUMENT_PRIVATE;
    }

    /**
     * Set the value of CAN EDIT DOCUMENT PRIVATE.
     *
     * @param mixed CAN_EDIT_DOCUMENT_PRIVATE
     *
     * @return self
     */
    public function setCAN_EDIT_DOCUMENT_PRIVATE($CAN_EDIT_DOCUMENT_PRIVATE)
    {
        $this->CAN_EDIT_DOCUMENT_PRIVATE = $CAN_EDIT_DOCUMENT_PRIVATE;

        return $this;
    }

    /**
     * Get the value of CAN EDIT DOCUMENT INTERNAL.
     *
     * @return mixed
     */
    public function getCAN_EDIT_DOCUMENT_INTERNAL()
    {
        return $this->CAN_EDIT_DOCUMENT_INTERNAL;
    }

    /**
     * Set the value of CAN EDIT DOCUMENT INTERNAL.
     *
     * @param mixed CAN_EDIT_DOCUMENT_INTERNAL
     *
     * @return self
     */
    public function setCAN_EDIT_DOCUMENT_INTERNAL($CAN_EDIT_DOCUMENT_INTERNAL)
    {
        $this->CAN_EDIT_DOCUMENT_INTERNAL = $CAN_EDIT_DOCUMENT_INTERNAL;

        return $this;
    }

    /**
     * Get the value of CAN EDIT DOCUMENT PUBLIC.
     *
     * @return mixed
     */
    public function getCAN_EDIT_DOCUMENT_PUBLIC()
    {
        return $this->CAN_EDIT_DOCUMENT_PUBLIC;
    }

    /**
     * Set the value of CAN EDIT DOCUMENT PUBLIC.
     *
     * @param mixed CAN_EDIT_DOCUMENT_PUBLIC
     *
     * @return self
     */
    public function setCAN_EDIT_DOCUMENT_PUBLIC($CAN_EDIT_DOCUMENT_PUBLIC)
    {
        $this->CAN_EDIT_DOCUMENT_PUBLIC = $CAN_EDIT_DOCUMENT_PUBLIC;

        return $this;
    }

    /**
     * Get the value of CAN DELETE DOCUMENT PRIVATE.
     *
     * @return mixed
     */
    public function getCAN_DELETE_DOCUMENT_PRIVATE()
    {
        return $this->CAN_DELETE_DOCUMENT_PRIVATE;
    }

    /**
     * Set the value of CAN DELETE DOCUMENT PRIVATE.
     *
     * @param mixed CAN_DELETE_DOCUMENT_PRIVATE
     *
     * @return self
     */
    public function setCAN_DELETE_DOCUMENT_PRIVATE($CAN_DELETE_DOCUMENT_PRIVATE)
    {
        $this->CAN_DELETE_DOCUMENT_PRIVATE = $CAN_DELETE_DOCUMENT_PRIVATE;

        return $this;
    }

    /**
     * Get the value of CAN DELETE DOCUMENT INTERNAL.
     *
     * @return mixed
     */
    public function getCAN_DELETE_DOCUMENT_INTERNAL()
    {
        return $this->CAN_DELETE_DOCUMENT_INTERNAL;
    }

    /**
     * Set the value of CAN DELETE DOCUMENT INTERNAL.
     *
     * @param mixed CAN_DELETE_DOCUMENT_INTERNAL
     *
     * @return self
     */
    public function setCAN_DELETE_DOCUMENT_INTERNAL($CAN_DELETE_DOCUMENT_INTERNAL)
    {
        $this->CAN_DELETE_DOCUMENT_INTERNAL = $CAN_DELETE_DOCUMENT_INTERNAL;

        return $this;
    }

    /**
     * Get the value of CAN DELETE DOCUMENT PUBLIC.
     *
     * @return mixed
     */
    public function getCAN_DELETE_DOCUMENT_PUBLIC()
    {
        return $this->CAN_DELETE_DOCUMENT_PUBLIC;
    }

    /**
     * Set the value of CAN DELETE DOCUMENT PUBLIC.
     *
     * @param mixed CAN_DELETE_DOCUMENT_PUBLIC
     *
     * @return self
     */
    public function setCAN_DELETE_DOCUMENT_PUBLIC($CAN_DELETE_DOCUMENT_PUBLIC)
    {
        $this->CAN_DELETE_DOCUMENT_PUBLIC = $CAN_DELETE_DOCUMENT_PUBLIC;

        return $this;
    }

    /**
     * Get the value of CAN COMMENT DOCUMENT PRIVATE.
     *
     * @return mixed
     */
    public function getCAN_COMMENT_DOCUMENT_PRIVATE()
    {
        return $this->CAN_COMMENT_DOCUMENT_PRIVATE;
    }

    /**
     * Set the value of CAN COMMENT DOCUMENT PRIVATE.
     *
     * @param mixed CAN_COMMENT_DOCUMENT_PRIVATE
     *
     * @return self
     */
    public function setCAN_COMMENT_DOCUMENT_PRIVATE($CAN_COMMENT_DOCUMENT_PRIVATE)
    {
        $this->CAN_COMMENT_DOCUMENT_PRIVATE = $CAN_COMMENT_DOCUMENT_PRIVATE;

        return $this;
    }

    /**
     * Get the value of CAN COMMENT DOCUMENT INTERNAL.
     *
     * @return mixed
     */
    public function getCAN_COMMENT_DOCUMENT_INTERNAL()
    {
        return $this->CAN_COMMENT_DOCUMENT_INTERNAL;
    }

    /**
     * Set the value of CAN COMMENT DOCUMENT INTERNAL.
     *
     * @param mixed CAN_COMMENT_DOCUMENT_INTERNAL
     *
     * @return self
     */
    public function setCAN_COMMENT_DOCUMENT_INTERNAL($CAN_COMMENT_DOCUMENT_INTERNAL)
    {
        $this->CAN_COMMENT_DOCUMENT_INTERNAL = $CAN_COMMENT_DOCUMENT_INTERNAL;

        return $this;
    }

    /**
     * Get the value of CAN COMMENT DOCUMENT PUBLIC.
     *
     * @return mixed
     */
    public function getCAN_COMMENT_DOCUMENT_PUBLIC()
    {
        return $this->CAN_COMMENT_DOCUMENT_PUBLIC;
    }

    /**
     * Set the value of CAN COMMENT DOCUMENT PUBLIC.
     *
     * @param mixed CAN_COMMENT_DOCUMENT_PUBLIC
     *
     * @return self
     */
    public function setCAN_COMMENT_DOCUMENT_PUBLIC($CAN_COMMENT_DOCUMENT_PUBLIC)
    {
        $this->CAN_COMMENT_DOCUMENT_PUBLIC = $CAN_COMMENT_DOCUMENT_PUBLIC;

        return $this;
    }

    /**
     * Get the value of CAN CREATE DOCUMENT PRIVATE.
     *
     * @return mixed
     */
    public function getCAN_CREATE_DOCUMENT_PRIVATE()
    {
        return $this->CAN_CREATE_DOCUMENT_PRIVATE;
    }

    /**
     * Set the value of CAN CREATE DOCUMENT PRIVATE.
     *
     * @param mixed CAN_CREATE_DOCUMENT_PRIVATE
     *
     * @return self
     */
    public function setCAN_CREATE_DOCUMENT_PRIVATE($CAN_CREATE_DOCUMENT_PRIVATE)
    {
        $this->CAN_CREATE_DOCUMENT_PRIVATE = $CAN_CREATE_DOCUMENT_PRIVATE;

        return $this;
    }

    /**
     * Get the value of CAN CREATE DOCUMENT INTERNAL.
     *
     * @return mixed
     */
    public function getCAN_CREATE_DOCUMENT_INTERNAL()
    {
        return $this->CAN_CREATE_DOCUMENT_INTERNAL;
    }

    /**
     * Set the value of CAN CREATE DOCUMENT INTERNAL.
     *
     * @param mixed CAN_CREATE_DOCUMENT_INTERNAL
     *
     * @return self
     */
    public function setCAN_CREATE_DOCUMENT_INTERNAL($CAN_CREATE_DOCUMENT_INTERNAL)
    {
        $this->CAN_CREATE_DOCUMENT_INTERNAL = $CAN_CREATE_DOCUMENT_INTERNAL;

        return $this;
    }

    /**
     * Get the value of CAN CREATE DOCUMENT PUBLIC.
     *
     * @return mixed
     */
    public function getCAN_CREATE_DOCUMENT_PUBLIC()
    {
        return $this->CAN_CREATE_DOCUMENT_PUBLIC;
    }

    /**
     * Set the value of CAN CREATE DOCUMENT PUBLIC.
     *
     * @param mixed CAN_CREATE_DOCUMENT_PUBLIC
     *
     * @return self
     */
    public function setCAN_CREATE_DOCUMENT_PUBLIC($CAN_CREATE_DOCUMENT_PUBLIC)
    {
        $this->CAN_CREATE_DOCUMENT_PUBLIC = $CAN_CREATE_DOCUMENT_PUBLIC;

        return $this;
    }

    /**
     * Get the value of CAN CREATE DOCUMENT TEXT.
     *
     * @return mixed
     */
    public function getCAN_CREATE_DOCUMENT_TEXT()
    {
        return $this->CAN_CREATE_DOCUMENT_TEXT;
    }

    /**
     * Set the value of CAN CREATE DOCUMENT TEXT.
     *
     * @param mixed CAN_CREATE_DOCUMENT_TEXT
     *
     * @return self
     */
    public function setCAN_CREATE_DOCUMENT_TEXT($CAN_CREATE_DOCUMENT_TEXT)
    {
        $this->CAN_CREATE_DOCUMENT_TEXT = $CAN_CREATE_DOCUMENT_TEXT;

        return $this;
    }

    /**
     * Get the value of CAN CREATE DOCUMENT BWL.
     *
     * @return mixed
     */
    public function getCAN_CREATE_DOCUMENT_BWL()
    {
        return $this->CAN_CREATE_DOCUMENT_BWL;
    }

    /**
     * Set the value of CAN CREATE DOCUMENT BWL.
     *
     * @param mixed CAN_CREATE_DOCUMENT_BWL
     *
     * @return self
     */
    public function setCAN_CREATE_DOCUMENT_BWL($CAN_CREATE_DOCUMENT_BWL)
    {
        $this->CAN_CREATE_DOCUMENT_BWL = $CAN_CREATE_DOCUMENT_BWL;

        return $this;
    }
}
