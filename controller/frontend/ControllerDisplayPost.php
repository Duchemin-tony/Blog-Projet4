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
            $userConnection = parent::connect($dataUser);
            if($userConnection != null)
            {
                if($userConnection == 'Adresse email non reconnu')
                {
                    parent::register($dataUser);
                    $this->addComment($comment, $postId, $_SESSION['id_user']);
                }
                else
                {
                    return $userConnection;
                }
            }
            else
            {
                $this->addComment($comment, $postId, $_SESSION['id_user']);
            }
        }
        else
        {
            return 'Tous les champs doivent étre rempli !';
        }
    }

    public function addComment($contentComment, $postId, $id_user)
    {
        date_default_timezone_set('Europe/Monaco');
        $dateTime = date("Y-m-d H:i:s");
        $dataComment = [
            'content' => $contentComment,
            'creation_date' => $dateTime,
            'post-id' => $postId,
            'id_user' => $idUser
        ];
        $comment = new Comment($dataComment);
        $this->commentManager()->add($comment);
        header("Location: $_SERVER[HTTP_REFERER]");
    }

    public function displayPost($postId)
    {
        $post = $this->PostManager()->getPost($postId);
        $commentsPost = $this->commentManager()->getListCommentsPost($postId);
        $viewDisplayPost = new View('postView');
        $viewDisplayPost->generate(array(
            'post' => $post,
            'commentsPost' => $commentsPost
        ));
    }


    public function setPostManager($postManager) { $this->_postManager = $postManager; }
    public function setCommentManager($commentManager) { $this->_commentManager = $commentManager; }

    public function PostManager() { return $this->_postManager; }
    public function commentManager() { return $this->_commentManager; }
}
