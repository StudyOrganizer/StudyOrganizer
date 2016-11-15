<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="teachers")
 */
class Teacher
{
    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\OneToOne(targetEntity="Application\Entity\User", mappedBy="teacher") */
    private $user;

    /** @ORM\ManyToMany(targetEntity="Application\Entity\Cours") */
    private $courses;

    /** @ORM\ManyToOne(targetEntity="Application\Entity\School", inversedBy="teachers") */
    private $school;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Cours", inversedBy="principals")
     */
    private $courses_lead;

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
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getCourses()
    {
        return $this->courses;
    }

    /**
     * @param mixed $courses
     */
    public function setCourses($courses)
    {
        $this->courses = $courses;
    }

    /**
     * @return mixed
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * @param mixed $school
     */
    public function setSchool($school)
    {
        $this->school = $school;
    }

    /**
     * @return mixed
     */
    public function getCoursesLead()
    {
        return $this->courses_lead;
    }

    /**
     * @param mixed $courses_lead
     */
    public function setCoursesLead($courses_lead)
    {
        $this->courses_lead = $courses_lead;
    }

}
