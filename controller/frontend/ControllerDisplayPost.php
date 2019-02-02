<?php

class ControllerDisplayPost extends Controller
{
    private $_postManager;
    private $_commentManager;

    public function __construct()
    {
        parent::__construct();
        $this->setPostManager(new PostManager());
        $this->setCommentManager(new CommentsManager());
    }

    public function alertComment($idComment)
    {
        $this->commentManager()->reportComment($idComment);
    }

    public function addUserComment($postId, $email, $password, $comment)
    {
        if(isset($postId) && (trim($email)) && (trim($password)) && (trim($comment)))
        {
            $dataUser = [
                'email' => htmlspecialchars($email),
                'password' => htmlspecialchars($password)
            ];
            $userConnexion = parent::connect($dataUser);
            if($userConnexion != null)
            {
                if($userConnexion == 'Email non reconnu')
                {
                    parent::register($dataUser);
                    $this->addComment($comment, $postId, $_SESSION['idUser']);
                }
                else
                {
                    return $userConnexion;
                }
            }
            else
            {
                $this->addComment($comment, $postId, $_SESSION['idUser']);
            }
        }
        else
        {
            return 'Tous les champs doivent étre rempli !';
        }
    }

    public function addComment($contentComment, $postId, $idUser)
    {
        date_default_timezone_set('Europe/Monaco');
        $dateTime = date("Y-m-d H:i:s");
        $dataComment = [
            'content' => $contentComment,
            'creationDate' => $dateTime,
            'postId' => $postId,
            'idUser' => $idUser
        ];
        $comment = new Comment($dataComment);
        $this->commentManager()->add($comment);
        header("Location: $_SERVER[HTTP_REFERER]");
    }

    public function displayPost($postId)
    {
        $post = $this->PostManager()->getPost($postId);
        $commentsPost = $this->commentManager()->getListCommentsPost($postId);
        $postView = new View('postView');
        $postView->generate(array(
            'post' => $post,
            'commentsPost' => $commentsPost
        ));
    }

    public function setPostManager($postManager) { $this->_postManager = $postManager; }

    public function postManager() { return $this->_postManager; }

    public function setCommentManager($commentManager) { $this->_commentManager = $commentManager; }

    public function commentManager() { return $this->_commentManager; }
}
