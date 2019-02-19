<?php

class ControllerAdmin
{
    private $_postManager;
    private $_commentManager;

    public function __construct()
    {
        $this->setPostManager(new PostManager());
        $this->setCommentManager(new CommentsManager());
    }

    /**
    * Affiche la liste des articles dans la partie Admin
    */
    public function accueilAdmin()
    {
        $posts = $this->postManager()->getListPosts();
        for($i = 0; $i < count($posts); $i++)
        {
            $nbrComments[$i] = $this->commentManager()->getNbrComments($posts[$i]->id()); // Nombre de commentaire de chaque article
            $posts[$i]->setContent($this->cutText($posts[$i]->content(), 140)); 
            $posts[$i]->setTitle(ucfirst($posts[$i]->title()));
        }
        $nbrCommentAlert = count($this->commentManager()->getListCommentsAlert()); // Nombre de commentaire signalé
        $view = new View('admin');
        $view->generate(array(
            'posts' => $posts,
            'nbrComments' => $nbrComments,
            'nbrCommentAlert' => $nbrCommentAlert
        ));
    }


    private function cutText($text, $nbrChar)
    {
        $text = trim(strip_tags($text));
        if(is_numeric($nbrChar))
        {
            $PointSuspension = ' ...';
            $LengthText = strlen($text);
            if ($LengthText > $nbrChar) {
                $text = substr($text, 0, strpos($text, ' ', $nbrChar));
                $text .= $PointSuspension;
            }
        }
        return $text;
    }

    /**
    * Permet de supprimer un article et ses commentaires
    */
    public function deletePost($postId)
    {
        $this->postManager()->delete($postId);
        $this->commentManager()->deleteCommentPost($postId);
    }

    public function setPostManager($postManager) { $this->_postManager = $postManager; }
    public function postManager() { return $this->_postManager; }

    public function setCommentManager($commentManager) { $this->_commentManager = $commentManager; }
    public function commentManager() { return $this->_commentManager; }
}