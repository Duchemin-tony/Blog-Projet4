<?php

class ControllerConnect extends Controller
{
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
            return 'Pseudo et mot de passe obligatoire !';
        }
    }

    public function viewConnectUser()
    {
        $viewConnectUser = new View('connexion');
        $viewConnectUser->generate(array(''));
    }
}
