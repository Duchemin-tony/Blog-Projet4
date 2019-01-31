<?php

class User extends Hydrator
{
    private $_id;
    private $_email;
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

    public function setEmail($email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            trigger_error('L\'adresse email saisi n\'est pas valide', E_USER_WARNING);
            return;
        }
        $this->_email = $email;
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

    public function email()
    {
        return $this->_email;
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
