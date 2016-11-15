<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="schools")
 */
class School
{
    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="string", name="name", nullable=false) */
    private $name;

    /** @ORM\Column(type="string", name="describtion", nullable=true) */
    private $desc;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Cours", mappedBy="school")
     */
    private $courses;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Teacher", mappedBy="school")
     */
    private $teachers;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Student", mappedBy="school")
     */
    private $students;

    /**
     * @ORM\OneToOne(targetEntity="Application\Entity\Student")
     */
    private $student_lead;

    /**
     * @ORM\OneToOne(targetEntity="Application\Entity\Teacher")
     */
    private $headmaster;

    /** @ORM\ManyToMany(targetEntity="Application\Entity\Notification", inversedBy="school") */
    private $notifications;

    /** @ORM\ManyToMany(targetEntity="Application\Entity\StudentUIDashboardCard", inversedBy="school") */
    private $dashboard_cards;

    /** @ORM\OneToMany(targetEntity="Application\Entity\SubjectTime", mappedBy="school") */
    private $times;

    /** @ORM\OneToMany(targetEntity="Application\Entity\Subject", mappedBy="school") */
    private $subjects;

    public function __construct()
    {
        $this->dashboard_cards = new ArrayCollection();
        $this->notifications = new ArrayCollection();
        $this->dashboard_cards = new ArrayCollection();
    }

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
        $this->name = $name;
    }

    /**
     * Get the value of Courses.
     *
     * @return mixed
     */
    public function getCourses()
    {
        return $this->courses;
    }

    /**
     * Set the value of Courses.
     *
     * @param mixed courses
     *
     * @return self
     */
    public function setCourses($courses)
    {
        $this->courses = $courses;
    }

    /**
     * Get the value of Teachers.
     *
     * @return mixed
     */
    public function getTeachers()
    {
        return $this->teachers;
    }

    /**
     * Set the value of Teachers.
     *
     * @param mixed teachers
     *
     * @return self
     */
    public function setTeachers($teachers)
    {
        $this->teachers = $teachers;
    }

    /**
     * Get the value of Students.
     *
     * @return mixed
     */
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * Set the value of Students.
     *
     * @param mixed students
     *
     * @return self
     */
    public function setStudents($students)
    {
        $this->students = $students;
    }

    /**
     * Get the value of Desc.
     *
     * @return mixed
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * Set the value of Desc.
     *
     * @param mixed desc
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;
    }

    /**
     * Get the value of Student Lead.
     *
     * @return mixed
     */
    public function getStudentLead()
    {
        return $this->student_lead;
    }

    /**
     * Set the value of Student Lead.
     *
     * @param mixed student_lead
     */
    public function setStudentLead($student_lead)
    {
        $this->student_lead = $student_lead;
    }

    /**
     * Get the value of Headmaster.
     *
     * @return mixed
     */
    public function getHeadmaster()
    {
        return $this->headmaster;
    }

    /**
     * Set the value of Headmaster.
     *
     * @param mixed headmaster
     */
    public function setHeadmaster($headmaster)
    {
        $this->headmaster = $headmaster;
    }


    /**
     * Add Group.
     *
     * @param CoursGroup $group
     * @return self
     */
    public function addDashboardCard(StudentUIDashboardCard $card)
    {
        $this->dashboard_cards->add($card);
        return $this;
    }

    /**
     * Add cards.
     *
     * @param Collection|array $cards
     * @return self
     */
    public function addDashboardCards($cards)
    {
        foreach($cards as $card){
            $this->addGroup($card);
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDashboardCards()
    {
        return $this->dashboard_cards;
    }

    /**
     * @param mixed $dashboard_cards
     */
    public function setDashboardCards($dashboard_cards)
    {
        $this->dashboard_cards = $dashboard_cards;
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
    public function getSubjects()
    {
        return $this->subjects;
    }

    /**
     * @param mixed $subjects
     */
    public function setSubjects($subjects)
    {
        $this->subjects = $subjects;
    }



}
