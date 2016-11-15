<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users", indexes={@ORM\Index(name="search_idx", columns={"username", "email"})}, uniqueConstraints={@ORM\UniqueConstraint(name="user_unique", columns={"username", "email"})})
 */
class User
{
    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="string", name="username", nullable=false) */
    private $username;

    /** @ORM\Column(type="string", name="password", nullable=false) */
    private $password;

    /** @ORM\Column(type="string", name="firstsname", nullable=true) */
    private $firstName;

    /** @ORM\Column(type="string", name="lastname", nullable=true) */
    private $lastName;

    /** @ORM\Column(type="string", name="email", nullable=false) */
    private $email;

    /** @ORM\Column(type="string", name="location", nullable=true) */
    private $location;

    /** @ORM\Column(type="text", name="aboutme", nullable=true) */
    private $aboutme;

    /** @ORM\Column(type="text", name="homepage", nullable=true) */
    private $homepage;

    /** @ORM\Column(type="string", name="avatar", nullable=true) */
    private $avatar;

    /** @ORM\OneToOne(targetEntity="Application\Entity\Teacher", inversedBy="user") */
    private $teacher;

    /** @ORM\OneToOne(targetEntity="Application\Entity\Student", inversedBy="user") */
    private $student;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Permission")
     **/
    private $permission;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Token", mappedBy="user")
     */
    private $tokens;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Skill", mappedBy="user")
     */
    private $skills;

    /** @ORM\ManyToMany(targetEntity="Application\Entity\Notification", inversedBy="user") */
    private $notifications;

    /** @ORM\ManyToMany(targetEntity="Application\Entity\UserGroup", inversedBy="members") */
    private $user_groups;

    /** @ORM\OneToOne(targetEntity="Application\Entity\TimeTable", inversedBy="user") */
    private $timetable;

    /** @ORM\Column(type="boolean", name="firstlogin", nullable=true) */
    private $firstlogin;

    /** @ORM\Column(type="boolean", name="mute", nullable=true) */
    private $mute;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Document", mappedBy="owner")
     */
    private $documents;


    /**
     * Get the value of Id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id.
     *
     * @param mixed id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get the value of Username.
     *
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of Username.
     *
     * @param mixed username
     *
     * @return self
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get the value of Password.
     *
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of Password.
     *
     * @param mixed password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get the value of First Name.
     *
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of First Name.
     *
     * @param mixed firstName
     *
     * @return self
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Get the value of Last Name.
     *
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of Last Name.
     *
     * @param mixed lastName
     *
     * @return self
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * Get the value of Email.
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of Email.
     *
     * @param mixed email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get the value of Teacher.
     *
     * @return mixed
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * Set the value of Teacher.
     *
     * @param mixed teacher
     *
     * @return self
     */
    public function setTeacher($teacher)
    {
        $this->teacher = $teacher;
    }

    /**
     * Get the value of Student.
     *
     * @return mixed
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Set the value of Student.
     *
     * @param mixed student
     *
     * @return self
     */
    public function setStudent($student)
    {
        $this->student = $student;
    }

    /**
     * Get the value of Access Group.
     *
     * @return mixed
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * Set the value of Access Group.
     *
     * @param mixed access_group
     *
     * @return self
     */
    public function setPermission($permission)
    {
        $this->permission = $permission;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function getTokens()
    {
        return $this->tokens;
    }

    public function getNotifications()
    {
        return $this->notifications;
    }

    public function getUser_groups()
    {
        return $this->user_groups;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    public function setTokens($tokens)
    {
        $this->tokens = $tokens;
    }

    public function setNotifications($notifications)
    {
        $this->notifications = $notifications;
    }

    public function setUser_groups($user_groups)
    {
        $this->user_groups = $user_groups;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function getAboutme()
    {
        return $this->aboutme;
    }

    public function getHomepage()
    {
        return $this->homepage;
    }

    public function setLocation($location)
    {
        $this->location = $location;
    }

    public function setAboutme($aboutme)
    {
        $this->aboutme = $aboutme;
    }

    public function setHomepage($homepage)
    {
        $this->homepage = $homepage;
    }

    /**
     * @return mixed
     */
    public function getTimetable()
    {
        return $this->timetable;
    }

    /**
     * @param mixed $timetable
     */
    public function setTimetable($timetable)
    {
        $this->timetable = $timetable;
    }

    /**
     * @return mixed
     */
    public function getFirstlogin()
    {
        return $this->firstlogin;
    }

    /**
     * @param mixed $firstlogin
     */
    public function setFirstlogin($firstlogin)
    {
        $this->firstlogin = $firstlogin;
    }

    /**
     * @return mixed
     */
    public function getMute()
    {
        return $this->mute;
    }

    /**
     * @param mixed $mute
     */
    public function setMute($mute)
    {
        $this->mute = $mute;
    }

    /**
     * @return mixed
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * @param mixed $skills
     */
    public function setSkills($skills)
    {
        $this->skills = $skills;
    }

    /**
     * @return mixed
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * @param mixed $documents
     */
    public function setDocuments($documents)
    {
        $this->documents = $documents;
    }




}
