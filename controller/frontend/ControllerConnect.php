<?php

class ControllerConnect extends Controller
{

    /**
    * Permet la connexion d'un membre
    */
    function callConnectUser($post)
    {
        if((trim($post['pseudo'])) && (trim($post['password'])))
        {
            $dataUser = [
                'pseudo' => htmlspecialchars($post['pseudo']),
                'password' => htmlspecialchars($post['password'])
            ];
            return parent::connect($dataUser);
        }
        else
        {
            return 'Pseudo et mot de passe obligatoire !';
        }
    }

    /**
    * Génère la vue de la connexion
    */
    public function viewConnectUser()
    {
        $viewConnectUser = new View('connexion');
        $viewConnectUser->generate(array(''));
    }
}
