<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="share_voc")
 */
class ShareVoc
{
    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="boolean", name="public", nullable=false) */
    private $public;
    
    /** @ORM\Column(type="boolean", name="intern", nullable=false) */
    private $intern;
    
    /**
     * @ORM\OneToOne(targetEntity="Application\Entity\Student", inversedBy="lead")
     */    
    //private $intern_share_list;
        
    /** @ORM\Column(type="boolean", name="private", nullable=false) */
    private $private;
    
    /**    
     * @ORM\OneToOne(targetEntity="Application\Entity\VocabularyStack", inversedBy="share")
     */
    private $voc_stack;
    
    function getId() {
        return $this->id;
    }

    function getPublic() {
        return $this->public;
    }

    function getIntern() {
        return $this->intern;
    }

    function getPrivate() {
        return $this->private;
    }

    function getVoc_stack() {
        return $this->voc_stack;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPublic($public) {
        $this->public = $public;
    }

    function setIntern($intern) {
        $this->intern = $intern;
    }

    function setPrivate($private) {
        $this->private = $private;
    }

    function setVoc_stack($voc_stack) {
        $this->voc_stack = $voc_stack;
    }    
}
