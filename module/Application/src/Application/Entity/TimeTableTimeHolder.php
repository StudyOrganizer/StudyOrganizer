<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
* @ORM\Entity
* @ORM\Table(name="timetable_time_holder")
*/
class TimeTableTimeHolder {

    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\ManyToOne(targetEntity="Application\Entity\SubjectTime", inversedBy="holder") */
    private $times;

    /** @ORM\ManyToMany(targetEntity="Application\Entity\TimeTable", mappedBy="time_holder") */
    private $timetable;

    /** @ORM\ManyToMany(targetEntity="Application\Entity\TimeTableSubjectHolder", inversedBy="time_holder") */
    private $subject_holder;

    public function __construct() {
        $this->subject_holder = new ArrayCollection();
    }

    /**
     * @param TimeTableSubjectHolder $holder
     */
    public function addTimeSubjectHolder(TimeTableSubjectHolder $holder) {
        $this->subject_holder->add($holder);
    }

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
    public function getTimes()
    {
        return $this->times;
    }

    /**
     * @param mixed $times
     */
    public function setTimes($times)
    {
        $this->times = $times;
    }

    /**
     * @return mixed
     */
    public function getTimetable()
    {
        return $this->timetable;
    }

    /**
     * @param mixed $timetable
     */
    public function setTimetable($timetable)
    {
        $this->timetable = $timetable;
    }

    /**
     * @return mixed
     */
    public function getSubjectHolder()
    {
        return $this->subject_holder;
    }

    /**
     * @param mixed $subject_holder
     */
    public function setSubjectHolder($subject_holder)
    {
        $this->subject_holder = $subject_holder;
    }
}