<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="user_groups",  uniqueConstraints={@ORM\UniqueConstraint(name="user_group_unique", columns={"name"})})
 */
class UserGroup
{
    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="string", name="name", nullable=false) */
    private $name;

    /** @ORM\ManyToMany(targetEntity="Application\Entity\User", mappedBy="user_groups") */
    private $members;

    /** @ORM\ManyToMany(targetEntity="Application\Entity\StudentUIDashboardCard", inversedBy="user_groups") */
    private $dashboard_cards;

    public function __construct()
    {
        $this->dashboard_cards = new ArrayCollection();
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
