<?php

class ControllerRegister extends Controller
{

    public function registerUser($post)
    {
        if((trim($post['email'])) && (trim($post['emailConfirm'])) && (trim($post['password'])) && (trim($post['passwordConfirm'])))
        {
            $post['email'] = htmlspecialchars($post['email']);
            $post['emailConfirm']= htmlspecialchars($post['emailConfirm']);
            $post['password'] = htmlspecialchars($post['password']);
            $post['passwordConfirm'] = htmlspecialchars($post['passwordConfirm']);
            
            if($post['email'] == $post['emailConfirm'])
            {
                if($post['password'] == $post['passwordConfirm'])
                {
                    $dataUser = [
                        'email' => $post['email'],
                        'password' => $post['password']
                    ];
                    $stateRegister = parent::connect($dataUser);
                    if($stateRegister == 'Vous n\'êtes pas inscrit')
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
                return 'Merci de confirmer votre Pseudo';
            }
        }
        else
        {
            return 'Les champs ne peuvent pas être vides !';
        }
    }

    public function viewRegisterUser()
    {
        $viewRegisterUser = new View('register');

        $viewRegisterUser->generate(array(''));
    }
}
