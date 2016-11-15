<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="documents")
 */
class Document
{
    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\User", inversedBy="documents")
     */
    private $owner;

    /** @ORM\Column(type="string", name="title", nullable=false) */
    private $title;

    /** @ORM\Column(type="text", name="content", nullable=false) */
    private $content;

    /**
     * @ORM\OneToOne(targetEntity="Application\Entity\DocumentFile", mappedBy="document")
     */
    private $document_file;

    /**
     * @ORM\OneToOne(targetEntity="Application\Entity\PublicDocument", mappedBy="document")
     */
    private $public;

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
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param mixed $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getDocumentFile()
    {
        return $this->document_file;
    }

    /**
     * @param mixed $document_file
     */
    public function setDocumentFile($document_file)
    {
        $this->document_file = $document_file;
    }

    /**
     * @return mixed
     */
    public function getPublic()
    {
        return $this->public;
    }

    /**
     * @param mixed $public
     */
    public function setPublic($public)
    {
        $this->public = $public;
    }

}
