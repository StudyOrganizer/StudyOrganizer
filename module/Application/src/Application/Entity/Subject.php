<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="subjects")
 */
class Subject
{
    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="string", name="name", nullable=false) */
    private $name;

    /** @ORM\Column(type="string", name="icon", nullable=false) */
    private $icon;
    
    /** @ORM\Column(type="boolean", name="langugae", nullable=false) */
    private $language;

    /** @ORM\ManyToOne(targetEntity="Application\Entity\School", inversedBy="subjects") */
    private $school;

    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Cours", mappedBy="subjects")
     */
    private $courses;


    /** @ORM\OneToMany(targetEntity="Application\Entity\TimeTableSubjectHolder", mappedBy="subject") */
    private $holder;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param mixed $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
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
    public function getHolder()
    {
        return $this->holder;
    }

    /**
     * @param mixed $holder
     */
    public function setHolder($holder)
    {
        $this->holder = $holder;
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
     * @ORM\OneToMany(targetEntity="Application\Entity\Skill", mappedBy="subject")
     */
    private $skills;


}