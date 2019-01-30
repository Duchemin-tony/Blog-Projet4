<?php 

class LoginManager extends Manager
{
	public function getLogin($login)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM users WHERE login = :login');
        $req->execute(array(
           'login' => $login));
        $loginAdmin = $req->fetch();
        return $loginAdmin;
    }
} 