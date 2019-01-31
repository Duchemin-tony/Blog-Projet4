<?php

spl_autoload_register(function ($class) {
    if($class === 'Controller')
    {
        require_once('controller/' . $class . '.php');
    }
    elseif(strpos($class, "Controller") === 0)
    {
        require_once('controller/frontend/' . $class . '.php');
    }
    elseif (strpos($class, "View") === 0) {
        require_once('view/frontend/' . $class . '.php');
    }
    else
    {
        require_once('model/' . $class . '.php');
    }
});

class Router
{
    private $_ctrlIndex;
    private $_ctrlConnect;
    private $_ctrlRegistration;
    private $_ctrlDisplayPost;

    public function __construct()
    {
        $this->setCtrlIndex(new ControllerIndex());
        $this->setCtrlDisplayPost(new ControllerDisplayPost());
    }

    public function routeRequest()
    {
        try
        {
            if(isset($_GET['action']))
            {
                if($_GET['action'] == 'post')
                {
                    try
                    {
                        if($_SERVER["REQUEST_METHOD"] == "POST")
                        {
                            if(isset($_POST['reportComment']) && ($_POST['reportComment'] == 'reportComment'))
                            {
                                $_POST['idComment'] = intval($_POST['idComment']);

                                if($_POST['idComment'] != 0)
                                {
                                    $this->ctrlDisplayTicket()->alertComment($_POST['idComment']);
                                }
                                else
                                {
                                    throw new Exception("Identifiant de commentaire incorrect");
                                }
                            }
                            else if(isset($_POST['publicationComment']) && ($_POST['publicationComment'] == 'publicationComment')) 
                            {
                                if(isset($_SESSION['email']) && (isset($_SESSION['id_user'])))
                                {
                                    $this->ctrlDisplayTicket()->addComment($_POST['comment'], $_POST['post_id'], $_SESSION['id_user']);
                                }
                                else {
                                    $_SESSION['errorPostComment'] = $this->ctrlDisplayPost()->addUserComment($_POST['post_id'], $_POST['email'], $_POST['password'], $_POST['comment']);
                                }
                            }
                        }

                        if(isset($_GET['id']))
                        {
                            $_GET['id'] = intval($_GET['id']);

                            if($_GET['id'] != 0)
                            {
                                $this->ctrlDisplayPost()->displayPost($_GET['id']);
                            }
                            else
                            {
                                throw new Exception("Identifiant d'article incorrect");
                            }
                        }
                    }
                    catch(Exception $e)
                    {
                        $this->error($e->getMessage());
                    }
                }
                else if($_GET['action'] == 'connexion')
                {
                    try
                    {
                        if($_SERVER["REQUEST_METHOD"] == "POST")
                        {
                            $_SESSION['errorConnect'] = $this->ctrlConnect()->callConnectUser($_POST);
                        }
                        $this->ctrlConnect()->viewConnectUser();
                    }
                    catch(Exception $e)
                    {
                        $this->error($e->getMessage());
                    }
                }
                else if($_GET['action'] == 'register')
                {
                    try
                    {
                        if($_SERVER["REQUEST_METHOD"] == "POST")
                        {
                            $_SESSION['errorRegister'] = $this->ctrlRegister()->registerUser($_POST);
                        }
                        $this->ctrlRegister()->viewRegisterUser();
                    }
                    catch(Exception $e)
                    {
                        $this->error($e->getMessage());
                    }
                }
                else if($_GET['action'] == 'deconnexion')
                {
                    session_destroy();
                    header("Location: $_SERVER[HTTP_REFERER]");
                }
            }
            else
            {
                $this->ctrlIndex()->callGetPosts();
            }
        }
        catch(Exception $e)
        {
            $this->error($e->getMessage());
        }
    }

    private function error($msgErreur) {
        $viewError = new View("Error");
        $viewError->generate(array('msgErreur' => $msgErreur));
    }

    public function setCtrlIndex($ctrlIndex) { $this->_ctrlIndex = $ctrlIndex; }
    public function ctrlIndex() { return $this->_ctrlIndex; }

    public function setCtrlConnect($ctrlConnect) { $this->_ctrlConnect = $ctrlConnect; }
    public function ctrlConnect() { return $this->_ctrlConnect; }

    public function setCtrlRegister($ctrlRegister) { $this->_ctrlRegister = $ctrlRegister; }
    public function ctrlRegister() { return $this->_ctrlRegister; }

    public function setCtrlDisplayPost($ctrlDisplayPost) { $this->_ctrlDisplayPost = $ctrlDisplayPost; }
    public function ctrlDisplayPost() { return $this->_ctrlDisplayPost; }
}
