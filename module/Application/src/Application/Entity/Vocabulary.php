<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vocabularies")
 */
class Vocabulary
{
    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="string", name="content", nullable=false) */
    private $content;
    
    /** @ORM\Column(type="integer", name="level", nullable=false) */
    private $level;
    
    /**
    * @ORM\ManyToOne(targetEntity="Application\Entity\VocabularyStack", inversedBy="voc")
    */
    private $voc_stack;
    
    
    function getId() {
        return $this->id;
    }

    function getVoc_stack() {
        return $this->voc_stack;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setVoc_stack($voc_stack) {
        $this->voc_stack = $voc_stack;
    }
    
    function getContent() {
        return $this->content;
    }


    function setContent($content) {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }
}
