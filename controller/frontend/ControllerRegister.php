<?php

class ControllerRegister extends Controller
{

    /**
    * Permet d'inscrire un utilisateur
    */
    public function registerUser($post)
    {
        if((trim($post['pseudo'])) && (trim($post['pseudoConfirm'])) && (trim($post['password'])) && (trim($post['passwordConfirm'])))
        {
            $post['pseudo'] = htmlspecialchars($post['pseudo']);
            $post['pseudoConfirm']= htmlspecialchars($post['pseudoConfirm']);
            $post['password'] = htmlspecialchars($post['password']);
            $post['passwordConfirm'] = htmlspecialchars($post['passwordConfirm']);
            
            if($post['pseudo'] == $post['pseudoConfirm'])
            {
                if($post['password'] == $post['passwordConfirm'])
                {
                    $dataUser = [
                        'pseudo' => $post['pseudo'],
                        'password' => $post['password']
                    ];
                    $stateRegister = parent::connect($dataUser);
                    if($stateRegister == 'Pseudo non reconnu')
                    {
                        parent::register($dataUser);
                    }
                    else
                    {
                        return $stateRegister;
                    }
                }
                else
                {
                    return 'Merci de confirmer votre mot de passe';
                }
            }
            else
            {
                return 'Merci de confirmer votre pseudo';
            }
        }
        else
        {
            return 'Les champs ne peuvent pas être vides !';
        }
    }

    /**
    * Génère la vue d'inscription
    */
    public function viewRegisterUser()
    {
        $viewRegisterUser = new View('register');

        $viewRegisterUser->generate(array(''));
    }
}
