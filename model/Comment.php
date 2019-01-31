<?php

class Comment extends Hydrator
{

    private $_id;
    private $_content;
    private $_creationDate;
    private $_postId;
    private $_idUser;
    private $_alert;

    public function __construct(array $donnees)
    {
        parent::__construct($donnees);
    }

    public function setId($id)
    {
        $id = (int) $id;
        if($id > 0)
        {
            $this->_id = $id;
        }
    }

    public function setContent($content)
    {
        if(!is_string($content))
        {
            trigger_error('Le contenu du commentaire doit être une chaine de caractères', E_USER_WARNING);
            return;
        }

        $this->_content = $content;
    }

    public function setCreationDate($creationDate)
    {
        $this->_creationDate = $creationDate;
    }

    public function setPostId($postId)
    {
        $postId = (int) $postId;
        if($postId > 0)
        {
            $this->_postId = $postId;
        }
    }

    public function setIdUser($idUser)
    {
        $idUser = (int) $idUser;
        if($idUser > 0)
        {
            $this->_idUser = $idUser;
        }
    }

    public function id() { return $this->_id; }
    public function content() { return $this->_content; }
    public function creationDate() { return $this->_creationDate; }
    public function postId() { return $this->_postId; }
    public function idUser() { return $this->_idUser; }
    public function alert() { return $this->_alert; }
}
