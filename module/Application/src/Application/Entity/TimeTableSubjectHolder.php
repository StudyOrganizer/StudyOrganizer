<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="timetable_subject_holder")
 */
class TimeTableSubjectHolder {

    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\ManyToOne(targetEntity="Application\Entity\Subject", inversedBy="holder") */
    private $subject;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Cours", inversedBy="subject_related_holders")
     */
    private $cours;

    /** @ORM\ManyToMany(targetEntity="Application\Entity\TimeTableTimeHolder", mappedBy="subject_holder") */
    private $time_holder;

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
    public function getTimeHolder()
    {
        return $this->time_holder;
    }

    /**
     * @param mixed $time_holder
     */
    public function setTimeHolder($time_holder)
    {
        $this->time_holder = $time_holder;
    }

    /**
     * @return mixed
     */
    public function getCours()
    {
        return $this->cours;
    }

    /**
     * @param mixed $cours
     */
    public function setCours($cours)
    {
        $this->cours = $cours;
    }



}