<?php

class ControllerAdminSec extends Controller 
{
    /**
    * Vérifie le status d'un membre
    */
    public function autorisationEnter($sessionUser)
    {
        if(isset($sessionUser['idUser']) && (isset($sessionUser['email'])) && (isset($sessionUser['statusUser'])))
        {
            $dataUser = [
                'id' => $sessionUser['idUser'],
                'email' => $sessionUser['email'],
                'status' => $sessionUser['statusUser']
            ];

            $user = new User($dataUser);
            $userConnexion = $this->userManager()->connexionUser($user);
            if(($userConnexion->id() == $dataUser['id']) && ($userConnexion->email() == $dataUser['email']) && ($userConnexion->status() == $dataUser['status']))
            {
                return TRUE;
            }

            return FALSE;
        }
    }

    /**
    * Vérifie la connexion à l'administration 
    */
    public function connectAdmin($email, $password)
    {
        $dataUser = [
            'email' => htmlspecialchars($email),
            'password' => htmlspecialchars($password)
        ];
        $userConnexion = parent::connect($dataUser);
        if($userConnexion == null) 
        {
            if($_SESSION['statusUser'] == 'administrateur') 
            {
                header('Location:admin.php');
            }
            else 
            {
                return 'Vous n\'étes pas autoriser à administrer le Blog';
            }
        }
        else 
        {
            return $userConnexion; 
        }
    }

    /**
    * Génére la vue pour la connexion à l'administration
    */
    public function adminSec()
    {
        $adminSec = new View('adminSec');
        $adminSec->generate(array(''));
    }
}