<?php
namespace StudentUI\Entity;

class TestList {
    private $id;
    private $title;
    private $subject;
    private $level;
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

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    public function getTimestoGo() {
        $now = new \DateTime("now");
        $date = $this->expiretime;
        $interval = $now->diff($date);
        return $interval->days . " days and ". $interval->h . " hours";
    }

    public function getDays() {
        $now = new \DateTime("now");
        $date = $this->expiretime;
        $interval = $now->diff($date);
        return $interval->days;
    }

    public function getBadgeColor() {
        $level =  $this->level;
        if($level == "") {
            $level = 2;
        }
        switch($level) {
            case 1:
                if($this->getDays() <= 0) {
                    return "badge-danger";
                } elseif ($this->getDays() <= 2) {
                    return "badge-warning";
                } else {
                    return "badge-success";
                }
                break;
            case 2:
                if($this->getDays() <= 1) {
                    return "badge-danger";
                } elseif ($this->getDays() <= 4) {
                    return "badge-warning";
                } else {
                    return "badge-success";
                }
                break;
            case 3;
                if($this->getDays() <= 2) {
                    return "badge-danger";
                } elseif ($this->getDays() <= 6) {
                    return "badge-warning";
                } else {
                    return "badge-success";
                }
                break;
        }
    }

}