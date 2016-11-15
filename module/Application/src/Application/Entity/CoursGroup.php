<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="cours_groups", uniqueConstraints={@ORM\UniqueConstraint(name="access_groups_unique", columns={"name"})})
 */
class CoursGroup
{
    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="string", name="name", nullable=false) */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Cours", mappedBy="groups")
     */
    private $courses;

    /**
     * @ORM\OneToOne(targetEntity="Application\Entity\Student", inversedBy="lead")
     */
    private $lead;

    /** @ORM\ManyToMany(targetEntity="Application\Entity\Notification", inversedBy="cours_group") */
    private $notifications;

    /** @ORM\ManyToMany(targetEntity="Application\Entity\StudentUIDashboardCard", inversedBy="cours_group") */
    private $dashboard_cards;

    public function __construct()
    {
        $this->dashboard_cards = new ArrayCollection();
        $this->notifications = new ArrayCollection();
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
}
