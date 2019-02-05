<?php

class ControllerComment
{
    private $_commentManager;

    public function __construct()
    {
        $this->setCommentManager(new CommentsManager()); 
    }

    /**
    * 
    */
    public function decisionComment($get)
    {
        if(isset($get['approb']) && ($get['approb'] == 'on')) 
        {
            $this->approbComment($get);
        }
        else if(isset($get['comment']) && ($get['comment'] == "on") && (isset($get['postId']))) 
        {
            $this->displayCommentsPost($get);
        }
        else if(isset($get['alertComments']) && ($get['alertComments'] == 'on')) 
        {
            $this->displayCommentsSignal();
        }
    }

    /**
    * Affiche les commentaires d'un article
    */
    private function displayCommentsPost($get)
    {
        $get['postId'] = intval($get['postId']);
        if($get['postId'] != 0)
        {
            $comments = $this->commentManager()->getListCommentsPost($get['postId']);
            if(count($comments) == 1)
            {
                $titleSection = 'Voici le commentaire pour l\'article : <br><span>' . $comments[0]->titlePost() . '</span>';
            }
            else if(count($comments) > 1)
            {
                $titleSection = 'Voici les commentaires pour l\'article :<br><span>' . $comments[0]->titlePost() . '</span>';
            }
            else 
            {
                $titleSection = '';
            }
            $view = new View('comment');
            $view->generate(array(
                'comments' => $comments,
                'titleSection' => $titleSection
            ));
        }
        else
        {
            throw new Exception("Un identifiant contenu dans l'URL est incorrect");
        }
    }

    /**
    * Affiche les commentaires signalé
    */
    private function displayCommentsSignal()
    {
        $comments = $this->commentManager()->getListCommentsAlert();
        if(count($comments) == 1)
        {
            $titleSection = 'Vous avez ' . count($comments) . ' commentaire signaler :';
        }
        else if(count($comments) > 1)
        {
            $titleSection = 'Vous avez ' . count($comments) . ' commentaires signaler :';
        }
        else
        {
            header('Location:admin.php');
        }
        $view = new View('comment');
        $view->generate(array(
            'comments' => $comments,
            'titleSection' => $titleSection
        ));
    }

    /**
    * Permet d'approuver un commentaire
    */
    private function approbComment($get)
    {
        $get['id'] = intval($get['id']);
        if($get['id'] != 0)
        {
            $this->commentManager()->approb($get['id']);
            if(isset($get['alertComments']) && ($get['alertComments'] == 'on'))
            {
                $nbrCommentAlert = count($this->commentManager()->getListCommentsAlert());
                if($nbrCommentAlert != 0) 
                {
                    $urlRedirection = 'Location:admin.php?displayComment=comment&alertComments=on';
                    header($urlRedirection);
                }
            }
            else 
            {
                header("Location: $_SERVER[HTTP_REFERER]");
            }
        }
        else
        {
            throw new Exception("Identifiant de commentaire incorrect");
        }
    }

    /**
    * Supprime un Com
    */
    public function deleteComment($idComment)
    {
        $this->commentManager()->delete($idComment);
    }

    public function setCommentManager($commentManager) { $this->_commentManager = $commentManager; }
    public function commentManager() { return $this->_commentManager; }
}