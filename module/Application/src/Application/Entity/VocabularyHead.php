<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vocabulary_head")
 */
class VocabularyHead
{
    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="string", name="title", nullable=false) */
    private $title;
    
    /**
    * @ORM\ManyToOne(targetEntity="Application\Entity\VocabularyStack", inversedBy="voc_stack")
    */
    private $voc_head;  
    
    function getId() {
        return $this->id;
    }

    function getTitle() {
        return $this->title;
    }

    function getVoc_head() {
        return $this->voc_head;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setVoc_head($voc_head) {
        $this->voc_head = $voc_head;
    }


}