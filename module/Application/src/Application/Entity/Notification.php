<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="notification")
 */
class Notification
{
    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="string", name="title", nullable=false) */
    private $title;

    /** @ORM\Column(type="text", name="content", nullable=false) */
    private $content;

    /** @ORM\Column(type="string", name="intern_url", nullable=true) */
    private $intern_url;

    /** @ORM\Column(type="boolean", name="visible", nullable=false) */
    private $visible;

    /** @ORM\Column(type="datetime") */
    private $updated;

    /** @ORM\ManyToMany(targetEntity="Application\Entity\School", mappedBy="notifications") */
    private $school;

    /** @ORM\ManyToMany(targetEntity="Application\Entity\CoursGroup", mappedBy="notifications") */
    private $cours_group;

    /** @ORM\ManyToMany(targetEntity="Application\Entity\Cours", mappedBy="notifications") */
    private $cours;

    /** @ORM\ManyToMany(targetEntity="Application\Entity\User", mappedBy="notifications") */
    private $user;

    public function setUpdated()
    {
        $this->updated = new \DateTime('now');
    }
}
