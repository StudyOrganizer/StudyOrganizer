<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="courses", uniqueConstraints={@ORM\UniqueConstraint(name="access_groups_unique", columns={"name"})})
 */
class Cours
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
     * @ORM\ManyToOne(targetEntity="Application\Entity\School", inversedBy="courses")
     */
    private $school;

    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Student", mappedBy="courses_member")
     */
    private $members;

    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\CoursGroup", inversedBy="courses")
     */
    private $groups;

    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Subject", inversedBy="courses")
     */
    private $subjects;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\TimeTableSubjectHolder", mappedBy="cours")
     */
    private $subject_related_holders;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Teacher", mappedBy="courses_lead")
     */
    private $principals;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Student", mappedBy="courses_lead")
     */
    private $leads;

    /** @ORM\ManyToMany(targetEntity="Application\Entity\Notification", inversedBy="cours") */
    private $notifications;

    /** @ORM\ManyToMany(targetEntity="Application\Entity\StudentUIDashboardCard", inversedBy="cours") */
    private $dashboard_cards;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Homework", mappedBy="cours")
     */
    private $homeworks;
    
    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\VocabularyStack", mappedBy="cours")
     */
    private $voc_stack;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Test", mappedBy="cours")
     */
    private $tests;

    public function __construct()
    {
        $this->groups = new ArrayCollection();
        $this->dashboard_cards = new ArrayCollection();
        $this->subjects = new ArrayCollection();
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
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @param mixed $desc
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;
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
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * @param mixed $members
     */
    public function setMembers($members)
    {
        $this->members = $members;
    }

    /**
     * @return mixed
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param mixed $groups
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;
    }

    /**
     * Add Group.
     *
     * @param CoursGroup $group
     * @return self
     */
    public function addGroup(CoursGroup $group)
    {
        $this->groups->add($group);
        return $this;
    }

    /**
     * Add cards.
     *
     * @param Collection|array $cards
     * @return self
     */
    public function addGroups($groups)
    {
        foreach($groups as $group){
            $this->addGroup($group);
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrincipals()
    {
        return $this->principals;
    }

    /**
     * @param mixed $principals
     */
    public function setPrincipals($principals)
    {
        $this->principals = $principals;
    }

    /**
     * @return mixed
     */
    public function getLeads()
    {
        return $this->leads;
    }

    /**
     * @param mixed $leads
     */
    public function setLeads($leads)
    {
        $this->leads = $leads;
    }

    /**
     * @return mixed
     */
    public function getNotifications()
    {
        return $this->notifications;
    }

    /**
     * @param mixed $notifications
     */
    public function setNotifications($notifications)
    {
        $this->notifications = $notifications;
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

    /**
     * @param Subject $subject
     */
    public function addSubject(Subject $subject)
    {
        $this->subjects->add($subject);
    }

    /**
     * @return mixed
     */
    public function getHomeworks()
    {
        return $this->homeworks;
    }

    /**
     * @param mixed $homeworks
     */
    public function setHomeworks($homeworks)
    {
        $this->homeworks = $homeworks;
    }

    /**
     * @return mixed
     */
    public function getSubjectRelatedHolders()
    {
        return $this->subject_releated_holders;
    }

    /**
     * @param mixed $subject_releated_holders
     */
    public function setSubjectRelatedHolders($subject_releated_holders)
    {
        $this->subject_releated_holders = $subject_releated_holders;
    }

    /**
     * @return mixed
     */
    public function getTests()
    {
        return $this->tests;
    }

    /**
     * @param mixed $tests
     */
    public function setTests($tests)
    {
        $this->tests = $tests;
    }
    
    



}
