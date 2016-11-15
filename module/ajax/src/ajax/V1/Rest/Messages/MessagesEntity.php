<?php
namespace ajax\V1\Rest\Messages;

class MessagesEntity
{
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    private $id;
    private $username;
    private $email;
    private $firstname;
    private $lastname;
    private $content;
    private $hashtags;
    private $visible;
    private $updated;
    private $remimberDate;
    private $author_id;

    
    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    function getUsername() {
        return $this->username;
    }

    function getFirstname() {
        return $this->firstname;
    }

    function getLastname() {
        return $this->lastname;
    }

    function getContent() {
        return $this->content;
    }

    function getHashtags() {
        return $this->hashtags;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    function setContent($content) {
        $this->content = $content;
    }

    function setHashtags($hashtags) {
        $this->hashtags = $hashtags;
    }
    
    function getVisible() {
        return $this->visible;
    }

    function getUpdated() {
        return $this->updated;
    }

    function getRemimberDate() {
        return $this->remimberDate;
    }

    function setVisible($visible) {
        $this->visible = $visible;
    }

    function setUpdated($updated) {
        $this->updated = $updated;
    }

    function setRemimberDate($remimberDate) {
        $this->remimberDate = $remimberDate;
    }

    function getAuthor_id() {
        return $this->author_id;
    }

    function setAuthor_id($author_id) {
        $this->author_id = $author_id;
    }


}
