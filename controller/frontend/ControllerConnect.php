<?php

class ControllerConnect extends Controller
{

    /**
    * Permet la connexion d'un membre
    */
    function callConnectUser($post)
    {
        if((trim($post['email'])) && (trim($post['password'])))
        {
            $dataUser = [
                'email' => htmlspecialchars($post['email']),
                'password' => htmlspecialchars($post['password'])
            ];
            return parent::connect($dataUser);
        }
        else
        {
            return 'Email et mot de passe obligatoire !';
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
