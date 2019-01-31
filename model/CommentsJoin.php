<?php

class CommentsJoin extends Hydrator
{
    private $_idComment;
    private $_creationDateAddComment;
    private $_contentComment;
    private $_alertComment;
    private $_mailUser;
    private $_titlePost;
    private $_postId;

    public function __construct(array $donnees)
    {
        parent::__construct($donnees);
    }

    //SETTER

    public function setIdComment($idComment)
    {
        $idComment = (int) $idComment;
        if($idComment > 0)
        {
            $this->_idComment = $idComment;
        }
    }

    public function setCreationDateAddComment($creationDateAddComment) { $this->_creationDateAddComment = $creationDateAddComment; }
    public function setContentComment($contentComment)
    {
        if(!is_string($contentComment))
        {
            trigger_error('Le contenu du commentaire doit être une chaine de caractères', E_USER_WARNING);
            return;
        }

        $this->_contentComment = $contentComment;
    }

    public function setAlertComment($alertComment) { $this->_alertComment = $alertComment; }
    public function setMailUser($mailUser) { $this->_mailUser = $mailUser; }

    public function setTitlePost($titlePost)
    {
        if(!is_string($titlePost))
        {
            trigger_error('Le titre du chapitre doit être une chaine de caractères', E_USER_WARNING);
            return;
        }

        $this->_titlePost = $titlePost;
    }

    public function setIdPost($idPost)
    {
        $idPost = (int) $idPost; 
        if($idPost > 0)
        {
            $this->_idPost = $idPost;
        }
    }

    // GETTER

    public function idComment() { return $this->_idComment; }
    public function creationDateAddComment() { return $this->_creationDateAddComment; }
    public function contentComment() { return $this->_contentComment; }
    public function alertComment() { return $this->_alertComment; }
    public function mailUser() { return $this->_mailUser; }
    public function titlePost() { return $this->_titlePost; }
    public function postId() { return $this->_postId; }
}
