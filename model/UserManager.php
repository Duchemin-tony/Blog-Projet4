<?php

class UserManager extends Manager
{

    /**
    * Ajout d'un membre
    */
    public function addUser($user)
    {
        $bdd = parent::bddConnect();
        $request = $bdd->prepare('INSERT INTO users(email, password, status) VALUES(:email, :password, :status)');
        $request->bindValue(':email', $user->email());
        $request->bindValue(':password', $user->password());
        $request->bindValue(':status', 'contributeur');
        $request->execute() or die(print_r($request->errorInfo(), TRUE));
        return $bdd->lastInsertId();
    }

    /**
    * Connexion d'un membre
    */
    public function connexionUser($user)
    {
        $bdd = parent::bddConnect();
        $request = $bdd->prepare('SELECT id, email, password, status FROM users WHERE email = :email');
        $request->bindValue(':email', $user->email());
        $request->execute() or die(print_r($request->errorInfo(), TRUE));
        $dataConnexion = $request->fetch();
        if($dataConnexion)
        {
            $user = new User($dataConnexion);
            return $user;
        }
        return $dataConnexion;
    }
} 
