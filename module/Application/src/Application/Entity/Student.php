<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="students")
 */
class Student
{
    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\OneToOne(targetEntity="Application\Entity\User", mappedBy="student") */
    private $user;

    /** @ORM\ManyToOne(targetEntity="Application\Entity\School", inversedBy="students") */
    private $school;

    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Cours", inversedBy="members")
     **/
    private $courses_member;

    /** @ORM\ManyToMany(targetEntity="Application\Entity\StudentUIDashboardCard", inversedBy="students") */
    private $dashboard_cards;
    
    /** @ORM\OneToMany(targetEntity="Application\Entity\StudentUIDashboardCard", mappedBy="author") */
    private $author_card;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Cours", inversedBy="leads")
     */
    private $courses_lead;

    /**
     * @ORM\OneToOne(targetEntity="Application\Entity\CoursGroup", mappedBy="lead")
     */
    private $lead;

    public function __construct()
    {
        $this->courses_member = new ArrayCollection();
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

        return $this;
    }

    /**
     * Get the value of User.
     *
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of User.
     *
     * @param mixed user
     *
     * @return self
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of Subjects.
     *
     * @return mixed
     */
    public function getSubjects()
    {
        return $this->subjects;
    }

    /**
     * Set the value of Subjects.
     *
     * @param mixed subjects
     *
     * @return self
     */
    public function setSubjects($subjects)
    {
        $this->subjects = $subjects;

        return $this;
    }

    /**
     * Get the value of School.
     *
     * @return mixed
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * Set the value of School.
     *
     * @param mixed school
     *
     * @return self
     */
    public function setSchool($school)
    {
        $this->school = $school;

        return $this;
    }

    /**
     * Get the value of Courses.
     *
     * @return mixed
     */
    public function getCourses()
    {
        return $this->courses_member;
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
        $this->courses_member = $courses;
        return $this;
    }

    /**
     * Add Cours.
     *
     * @param CoursGroup $group
     * @return self
     */
    public function addCours(Cours $cours)
    {
        $this->courses_member->add($cours);
        return $this;
    }

    /**
     * Add courses.
     *
     * @param Collection|array $cards
     * @return self
     */
    public function addCourses($courses)
    {
        foreach($courses as $cours){
            $this->addCours($cours);
        }
        return $this;
    }
    
    /**
     * Add card.
     *
     * @param StudentUIDashboardCard $card
     * @return self
     */
    public function addStudentUICard(StudentUIDashboardCard $dashboard_card)
    {
    	$this->dashboard_cards->add($dashboard_card);
    	return $this;
    }
    
    /**
     * Add cards.
     *
     * @param Collection|array $cards
     * @return self
     */
    public function addStudentUICards($dashboard_cards)
    {
    	foreach($dashboard_cards as $card){
    		$this->addStudentUICard($card);
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
    public function getAuthorCard()
    {
        return $this->author_card;
    }

    /**
     * @param mixed $author_card
     */
    public function setAuthorCard($author_card)
    {
        $this->author_card = $author_card;
    }

    /**
     * @return mixed
     */
    public function getCoursesMember()
    {
        return $this->courses_member;
    }

    /**
     * @param mixed $courses_member
     */
    public function setCoursesMember($courses_member)
    {
        $this->courses_member = $courses_member;
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

    /**
     * @return mixed
     */
    public function getLead()
    {
        return $this->lead;
    }

    /**
     * @param mixed $lead
     */
    public function setLead($lead)
    {
        $this->lead = $lead;
    }


}
