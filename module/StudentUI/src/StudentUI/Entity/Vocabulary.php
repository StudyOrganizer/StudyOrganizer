<?php
namespace StudentUI\Entity;

class Vocabulary {
    private $content;
    
    function getContent() {
        return $this->content;
    }

    function setContent($content) {
        $this->content = $content;
    }    
}