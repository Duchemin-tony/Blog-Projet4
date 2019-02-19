<?php

class Controller
{
    private $_userManager;

    public function __construct()
    {
        $this->setUserManager(new UserManager());
    }

    /**
    * Permet la connexion d'un membre
    */
    public function connect($dataUser)
    {
        if(strlen($dataUser['pseudo']) >= 4)
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
                        $_SESSION['pseudo'] = $userConnexion->pseudo();
                        $_SESSION['statusUser'] = $userConnexion->status();
                    }
                    else
                    {
                        return 'Mot de passe incorrecte';
                    }
                }
                else
                {
                    return 'Pseudo non reconnu';
                }
            }
            else
            {
                return 'Le mot de passe doit faire au moins 4 caractères';
            }
        }
        else
        {
            return 'Le pseudo saisi n\'est pas valide';
        }
    }

    /**
    * Permet l'inscription d'un membre
    */
    public function register($dataUser)
    {
        $dataUser['password'] = password_hash($dataUser['password'], PASSWORD_DEFAULT);
        $user = new User($dataUser);
        $lastId = $this->userManager()->addUser($user);
        $_SESSION['idUser'] = $lastId;
        $_SESSION['pseudo'] = $user->pseudo();
        $_SESSION['statusUser'] = $user->status();
    }

    public function setUserManager($userManager) { $this->_userManager = $userManager; }
    public function userManager() { return $this->_userManager; }
}
