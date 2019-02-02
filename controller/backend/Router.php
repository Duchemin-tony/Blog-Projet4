<?php

spl_autoload_register(function ($class) {
    if($class === 'Controller')
    {
        require_once('controller/' . $class . '.php');
    }
    elseif(strpos($class, "Controller") === 0)
    {
        require_once('controller/backend/' . $class . '.php');
    }
    elseif (strpos($class, "View") === 0) {
        require_once('view/backend/' . $class . '.php');
    }
    else
    {
        require_once('model/' . $class . '.php');
    }
});

class Router
{
    private $_ctrlAdminSec;
    private $_ctrlAdmin;
    private $_ctrlPost;
    private $_ctrlComment;

    public function __construct()
    {
        $this->setCtrlAdminSec(new ControllerAdminSec());
        $this->setCtrlAdmin(new ControllerAdmin());
        $this->setCtrlPost(new ControllerPost());
        $this->setCtrlComment(new ControllerComment());
    }

    public function routeRequest()
    {
        if(isset($_SESSION['statusUser']) && ($_SESSION['statusUser'] == 'administrateur'))
        {
            if($this->ctrlAdminSec()->autorisationEnter($_SESSION))
            {
                try
                {
                    if(isset($_GET['action']))
                    {
                        if($_GET['action'] == 'post')
                        {
                            if($_SERVER["REQUEST_METHOD"] == "POST")
                            {
                                if(trim($_POST['titlePost']) && (trim($_POST['contentPost'])))
                                {
                                    $this->ctrlPost()->decisionPost($_POST);
                                }
                            }
                            $this->ctrlPost()->post($_GET);
                        }
                        else if($_GET['action'] == 'comment') 
                        {
                            $this->ctrlComment()->decisionComment($_GET);
                        }
                        else if($_GET['action'] == 'delete')
                        {
                            if(isset($_GET['deleteComment']) && (isset($_GET['idComment'])) && ($_GET['deleteComment'] == 'on')) 
                            {
                                $_GET['idComment'] = intval($_GET['idComment']); 
                                if($_GET['idComment'] != 0)
                                {
                                    $this->ctrlComment()->deleteComment($_GET['idComment']);
                                    header("Location: $_SERVER[HTTP_REFERER]");
                                }
                                else
                                {
                                    throw new Exception("Identifiant de commentaire incorrect");
                                }
                            }
                            else if(isset($_GET['deletePost']) && (isset($_GET['postId'])) && ($_GET['deletePost'] == 'on')) 
                            {
                                $_GET['postId'] = intval($_GET['postId']); 
                                if($_GET['postId'] != 0)
                                {
                                    $this->ctrlAdmin()->deletePost($_GET['postId']);
                                    header("Location: $_SERVER[HTTP_REFERER]");
                                }
                                else
                                {
                                    throw new Exception("Identifiant de chapitre incorrect");
                                }
                            }
                            if($_SERVER["REQUEST_METHOD"] == "POST")
                            {
                                if(isset($_POST['deletePost']) && (isset($_POST['postId'])) && (is_array($_POST['postId'])) && ($_POST['deletePost'] == 'on'))
                                {
                                    for($i = 0; $i < count($_POST['postId']); $i++) 
                                    {
                                        $_POST['postId'][$i] = intval($_POST['postId'][$i]); 
                                        if($_POST['postId'][$i] != 0)
                                        {
                                            $this->ctrlAdmin()->deletePost($_POST['postId'][$i]);
                                        }
                                        else
                                        {
                                            throw new Exception("Identifiant d'article incorrect");
                                        }
                                    }
                                    header("Location: $_SERVER[HTTP_REFERER]");
                                }
                            }
                        }
                    }
                    else
                    {
                        $this->ctrlAdmin()->accueilAdmin();
                    }
                }
                catch(Exception $e)
                {
                    $this->error($e->getMessage());
                }
            }
        }
        else 
        {
            try
            {
                if($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    if(trim($_POST['email']) && (trim($_POST['password'])))
                    {
                        $_SESSION['errorAdmin'] = $this->ctrlAdminSec()->connectAdmin($_POST['email'], $_POST['password']);
                    }
                }
                $this->ctrlAdminSec()->adminSec();
            }
            catch (Exception $e)
            {
                $this->error($e->getMessage());
            }
        }
    }

    private function error($msgErreur) {
        $viewError = new View("Error");
        $viewError->generate(array('msgErreur' => $msgErreur));
    }

    public function setCtrlAdminSec($ctrlAdminSec) { $this->_ctrlAdminSec = $ctrlAdminSec; }
    public function ctrlAdminSec() { return $this->_ctrlAdminSec; }

    public function setCtrlAdmin($ctrlAdmin) { $this->_ctrlAdmin = $ctrlAdmin; }
    public function ctrlAdmin() { return $this->_ctrlAdmin; }

    public function setCtrlPost($ctrlPost) { $this->_ctrlPost = $ctrlPost; }
    public function ctrlPost() { return $this->_ctrlPost; }

    public function setCtrlComment($ctrlComment) { $this->_ctrlComment = $ctrlComment; }
    public function ctrlComment() { return $this->_ctrlComment; }
}