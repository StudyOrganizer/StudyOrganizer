<?php
namespace StudentUI\Entity;

class HomeworkList {
    private $id;
    private $title;
    private $subject;
    private $expiretime;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getExpiretime()
    {
        return $this->expiretime;
    }

    /**
     * @param mixed $expiretime
     */
    public function setExpiretime($expiretime)
    {
        $this->expiretime = $expiretime;
    }
}