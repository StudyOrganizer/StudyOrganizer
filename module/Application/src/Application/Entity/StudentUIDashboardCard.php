<?php

namespace Application\Entity;

use Decoda\Filter\DefaultFilter;
use Decoda\Filter\ImageFilter;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Decoda\Decoda;
/**
 * @ORM\Entity
 * @ORM\Table(name="studentuidashboardcard")
 */
class StudentUIDashboardCard
{
    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="string", name="title", nullable=false) */
    private $title;

    /** @ORM\Column(type="string", name="typ", nullable=false) */
    private $typ;

    /** @ORM\Column(type="text", name="content", nullable=false) */
    private $content;

    /** @ORM\Column(type="string", name="intern_url", nullable=true) */
    private $intern_url;

    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Hashtag", mappedBy="student_cards")
     */
    private $hashtags;

    /** @ORM\Column(type="boolean", name="visible", nullable=false) */
    private $visible;

    /** @ORM\Column(type="datetime") */
    private $updated;

    /** @ORM\Column(type="datetime") */
    private $remimberDate;

    /** @ORM\ManyToMany(targetEntity="Application\Entity\School", mappedBy="dashboard_cards") */
    private $school;

    /** @ORM\ManyToMany(targetEntity="Application\Entity\CoursGroup", mappedBy="dashboard_cards") */
    private $cours_group;

    /** @ORM\ManyToMany(targetEntity="Application\Entity\Cours", mappedBy="dashboard_cards") */
    private $cours;

    /** @ORM\ManyToMany(targetEntity="Application\Entity\UserGroup", mappedBy="dashboard_cards") */
    private $user_groups;

    /** @ORM\ManyToMany(targetEntity="Application\Entity\Student", mappedBy="dashboard_cards") */
    private $students;
    
    /** @ORM\ManyToOne(targetEntity="Application\Entity\Student", inversedBy="author_card") */
    private $author;
    
    public function __construct()
    {
        $this->school = new ArrayCollection();
        $this->hashtags = new ArrayCollection();
        $this->user_groups = new ArrayCollection();
        $this->cours = new ArrayCollection();
        $this->cours_group = new ArrayCollection();
        $this->students = new ArrayCollection();
    }

    public function setUpdated()
    {
        $this->updated = new \DateTime('now');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getTyp()
    {
        return $this->typ;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getHTMLContent() {
        $content = new Decoda(str_replace(array('\r\n', '\n', "\r\n", "\n"), "\n", nl2br($this->content)));
        $content->addFilter(new ImageFilter());
        $content->addFilter(new DefaultFilter());
        return $content->parse();
    }

    public function getIntern_url()
    {
        return $this->intern_url;
    }

    public function getHashtags()
    {
        return $this->hashtags;
    }

    public function getVisible()
    {
        return $this->visible;
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    public function getRemimberDate()
    {
        return $this->remimberDate;
    }

    public function getSchool()
    {
        return $this->school;
    }

    public function getCours_group()
    {
        return $this->cours_group;
    }

    public function getCours()
    {
        return $this->cours;
    }

    public function getUser_groups()
    {
        return $this->user_groups;
    }

    public function getStudents()
    {
        return $this->students;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setTyp($typ)
    {
        $this->typ = $typ;
    }

    public function setContent($content)
    {
        $this->content = utf8_decode($content);
    }

    public function setIntern_url($intern_url)
    {
        $this->intern_url = $intern_url;
    }

    public function setHashtags($hashtags)
    {
        $this->hashtags = $hashtags;
    }

    public function setVisible($visible)
    {
        $this->visible = $visible;
    }

    public function setRemimberDate($remimberDate)
    {
        $this->remimberDate = $remimberDate;
    }

    public function setSchool($school)
    {
        $this->school = $school;
    }

    public function setCours_group($cours_group)
    {
        $this->cours_group = $cours_group;
    }

    public function setCours($cours)
    {
        $this->cours = $cours;
    }

    public function setUser_groups($user_groups)
    {
        $this->user_groups = $user_groups;
    }

    public function setStudents($students)
    {
        $this->students = $students;
    }
    
    function getAuthor() {
        return $this->author;
    }

    function setAuthor($author) {
        $this->author = $author;
    }

    /**
    * Add hashtag.
    *
    * @param Hashtag $hashtag
    * @return self
    */
   public function addHashtag(Hashtag $hashtag)
   {
       $this->hashtags->add($hashtag);
       return $this;
   }

   /**
    * Add hashtags.
    *
    * @param Collection|array $hashtags
    * @return self
    */
   public function addHashtags($hashtags)
   {
       foreach($hashtags as $hashtag){
           $this->addHashtag($hashtag);
       }
       return $this;
   }

   /**
    * Remove hashtag.
    *
    * @param Hashtag $hashtag
    * @return self
    */
   public function removeHashtag(Hashtag $hashtag)
   {
       $this->hashtags->removeElement($hashtag);
       return $this;
   }

   /**
    * Remove hashtags.
    *
    * @param Collection|array $hashtags
    * @return self
    */
   public function removeHashtags($hashtags)
   {
       foreach($hashtags as $hashtag){
           $this->removeHashtag($hashtag);
       }
       return $this;
   }
}
