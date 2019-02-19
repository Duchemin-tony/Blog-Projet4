<?php 

class CommentsJoin extends Hydrator 
{
    private $_idComment;
    private $_creationDateComment;
    private $_contentComment;
    private $_alertComment;
    private $_pseudoUser;
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

    public function setCreationDateComment($creationDateComment) 
    {
     $this->_creationDateComment = $creationDateComment; 
    }

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
    public function setPseudoUser($pseudoUser) { $this->_pseudoUser = $pseudoUser; }

    public function setTitlePost($titlePost)
    {
        if(!is_string($titlePost))
        {
            trigger_error('Le titre du chapitre doit être une chaine de caractères', E_USER_WARNING);
            return;
        }

        $this->_titlePost = $titlePost;
    }

    public function setPostId($postId)
    {
        $postId = (int) $postId; 
        if($postId > 0)
        {
            $this->_postId = $postId;
        }
    }

    // GETTER

    public function idComment() { return $this->_idComment; }
    public function creationDateComment() { return $this->_creationDateComment; }
    public function contentComment() { return $this->_contentComment; }
    public function alertComment() { return $this->_alertComment; }
    public function pseudoUser() { return $this->_pseudoUser; }
    public function titlePost() { return $this->_titlePost; }
    public function postId() { return $this->_postId; }
}
