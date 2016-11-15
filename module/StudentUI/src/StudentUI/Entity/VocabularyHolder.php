<?php
namespace StudentUI\Entity;

class VocabularyHolder {
    private $voc;
    
    function getVoc() {
        return $this->voc;
    }

    function setVoc($voc) {
        $this->voc = $voc;
    }
}