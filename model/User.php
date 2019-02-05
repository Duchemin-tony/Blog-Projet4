<?php

class User extends Hydrator
{
    private $_id;
    private $_pseudo;
    private $_password;
    private $_status;

    public function __construct(array $donnees)
    {
        parent::__construct($donnees);
    }

    public function setId($id)
    {
        $id = (int) $id;
        if($id > 0)
        {
            $this->_id = $id;
        }
    }

    public function setPseudo($pseudo)
    {
        if(!strlen($pseudo) >= 4)
        {
            trigger_error('Le pseudo saisi n\'est pas valide', E_USER_WARNING);
            return;
        }
        $this->_pseudo = $pseudo;
    }

    public function setPassword($password)
    {
        $this->_password = $password;
    }

    public function setStatus($status)
    {
        $this->_status = $status;
    }

    public function id()
    {
        return $this->_id;
    }

    public function pseudo()
    {
        return $this->_pseudo;
    }

    public function password()
    {
        return $this->_password;
    }

    public function status()
    {
        return $this->_status;
    }
}
