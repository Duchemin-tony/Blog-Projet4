<?php

class ControllerAdminSec extends Controller 
{
    /**
    * Vérifie le statut d'un membre
    */
    public function autorisationEnter($sessionUser)
    {
        if(isset($sessionUser['idUser']) && (isset($sessionUser['pseudo'])) && (isset($sessionUser['statusUser'])))
        {
            $dataUser = [
                'id' => $sessionUser['idUser'],
                'pseudo' => $sessionUser['pseudo'],
                'status' => $sessionUser['statusUser']
            ];

            $user = new User($dataUser);
            $userConnexion = $this->userManager()->connexionUser($user);
            if(($userConnexion->id() == $dataUser['id']) && ($userConnexion->pseudo() == $dataUser['pseudo']) && ($userConnexion->status() == $dataUser['status']))
            {
                return TRUE;
            }

            return FALSE;
        }
    }

    /**
    * Vérifie la connexion à l'administration 
    */
    public function connectAdmin($pseudo, $password)
    {
        $dataUser = [
            'pseudo' => htmlspecialchars($pseudo),
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