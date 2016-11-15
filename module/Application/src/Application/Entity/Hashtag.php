<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="hashtags",  uniqueConstraints={@ORM\UniqueConstraint(name="hashtag_unique", columns={"name"})})
 */
class Hashtag
{
    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="string", name="name", nullable=false) */
    private $name;

    /** @ORM\ManyToMany(targetEntity="Application\Entity\StudentUIDashboardCard", inversedBy="hashtags") */
    private $student_cards;
    
    public function __construct()
    {
    	$this->student_cards = new ArrayCollection();
    }


    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getStudent_cards()
    {
        return $this->student_cards;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setStudent_cards($student_cards)
    {
        $this->student_cards = $student_cards;
    }
    
    /**
     * Add card.
     *
     * @param StudentUIDashboardCard $card
     * @return self
     */
    public function addStudentUICard(StudentUIDashboardCard $card)
    {
    	$this->student_cards->add($card);
    	return $this;
    }
    
    /**
     * Add cards.
     *
     * @param Collection|array $cards
     * @return self
     */
    public function addStudentUICards($studentuicards)
    {
    	foreach($studentuicards as $card){
    		$this->addStudentUICard($card);
    	}
    	return $this;
    }
}
