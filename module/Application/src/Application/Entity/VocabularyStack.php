<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vocabulary_stacks",  uniqueConstraints={@ORM\UniqueConstraint(name="voc_stack_unique", columns={"name"})})
 */
class VocabularyStack
{
    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="string", name="name", nullable=false) */
    private $name;
    
    /** @ORM\Column(type="datetime") */
    private $updated;
    
    /** @ORM\Column(type="integer", name="size", nullable=false) */
    private $size;
    
    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Cours", inversedBy="voc_stack")
     */
    private $cours;
    
    /**    
     * @ORM\OneToOne(targetEntity="Application\Entity\ShareVoc", mappedBy="voc_stack")
     */
    private $share;
        
     /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Vocabulary", mappedBy="voc_stack")
     */
    private $voc;
    
    /**
    * @ORM\OneToMany(targetEntity="Application\Entity\VocabularyHead", mappedBy="voc_head")
    */
    private $voc_stack;
    
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getUpdated() {
        return $this->updated;
    }

    function getCours() {
        return $this->cours;
    }

    function getShare() {
        return $this->share;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setUpdated() {
        $this->updated = new \DateTime("now");
    }

    function setCours($cours) {
        $this->cours = $cours;
    }

    function setShare($share) {
        $this->share = $share;
    }    
    
    function getSize() {
        return $this->size;
    }

    function getVoc() {
        return $this->voc;
    }

    function setSize($size) {
        $this->size = $size;
    }

    function setVoc($voc) {
        $this->voc = $voc;
    }

    /**
     * @return mixed
     */
    public function getVocStack()
    {
        return $this->voc_stack;
    }

    /**
     * @param mixed $voc_stack
     */
    public function setVocStack($voc_stack)
    {
        $this->voc_stack = $voc_stack;
    }
}
