<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_token", uniqueConstraints={@ORM\UniqueConstraint(name="token_unique", columns={"token"})})
 */
class Token
{
    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="string", name="device_os", nullable=false) */
    private $deviceOS;

    /** @ORM\Column(type="string", name="device_name", nullable=false) */
    private $deviceName;

    /** @ORM\Column(type="datetime") */
    private $validStart;

    /** @ORM\Column(type="datetime") */
    private $validEnd;

    /** @ORM\Column(type="string", name="token", nullable=false) */
    private $token;

    /** @ORM\ManyToOne(targetEntity="Application\Entity\User", inversedBy="tokens") */
    private $user;

    public function setValidStart()
    {
        $this->validStart = new \DateTime('now');
    }
    
    public function getValidStart()
    {
        return $this->validStart;
    }
    
    function getId() {
        return $this->id;
    }

    function getDeviceOS() {
        return $this->deviceOS;
    }

    function getDeviceName() {
        return $this->deviceName;
    }

    function getValidEnd() {
        return $this->validEnd;
    }

    function getToken() {
        return $this->token;
    }

    function getUser() {
        return $this->user;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDeviceOS($deviceOS) {
        $this->deviceOS = $deviceOS;
    }

    function setDeviceName($deviceName) {
        $this->deviceName = $deviceName;
    }

    function setValidEnd($validEnd) {
        $this->validEnd = $validEnd;
    }

    function setToken($token) {
        $this->token = $token;
    }

    function setUser($user) {
        $this->user = $user;
    }


}
