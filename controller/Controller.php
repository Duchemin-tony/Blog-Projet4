<?php

class Controller
{
    private $_userManager;

    public function __construct()
    {
        $this->setUserManager(new UserManager());
    }

    public function connect($dataUser)
    {
        if(filter_var($dataUser['email'], FILTER_VALIDATE_EMAIL))
        {
            if(strlen($dataUser['password']) >= 4)
            {
                $user = new User($dataUser);
                $userConnexion = $this->userManager()->connexionUser($user);
                if($userConnexion)
                {
                    if(password_verify($dataUser['password'], $userConnexion->password()))
                    {
                        $_SESSION['idUser'] = $userConnexion->id();
                        $_SESSION['email'] = $userConnexion->email();
                        $_SESSION['statusUser'] = $userConnexion->status();
                    }
                    else
                    {
                        return 'Mot de passe incorrecte';
                    }
                }
                else
                {
                    return 'Email non reconnu';
                }
            }
            else
            {
                return 'Le mot de passe doit faire au moins 4 caractères';
            }
        }
        else
        {
            return 'L\'email saisi n\'est pas valide';
        }
    }

    public function register($dataUser)
    {
        $dataUser['password'] = password_hash($dataUser['password'], PASSWORD_DEFAULT);
        $user = new User($dataUser);
        $lastId = $this->userManager()->addUser($user);
        $_SESSION['idUser'] = $lastId;
        $_SESSION['email'] = $user->email();
        $_SESSION['statusUser'] = $user->status();
    }

    public function setUserManager($userManager) { $this->_userManager = $userManager; }
    public function userManager() { return $this->_userManager; }
}
