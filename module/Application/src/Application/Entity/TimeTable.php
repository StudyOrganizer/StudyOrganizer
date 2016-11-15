<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="timetable")
 */
class TimeTable
{
    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="string", name="name", nullable=false) */
    private $name;

    /** @ORM\ManyToMany(targetEntity="Application\Entity\TimeTableTimeHolder", inversedBy="timetable") */
    private $time_holder;

    /** @ORM\Column(type="boolean", name="uptodate", nullable=false) */
    private $uptopdate;

    /** @ORM\OneToOne(targetEntity="Application\Entity\User", mappedBy="timetable") */
    private $user;

    public function __construct() {
        $this->time_holder = new ArrayCollection();
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
    public function getUptopdate()
    {
        return $this->uptopdate;
    }

    /**
     * @param mixed $uptopdate
     */
    public function setUptopdate($uptopdate)
    {
        $this->uptopdate = $uptopdate;
    }

    /**
     * add time presenter
     * @param TimeTableTimeHolder $holder holder
     */
    public function addTimeHolder(TimeTableTimeHolder $holder) {
        $this->time_holder->add($holder);
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
}
