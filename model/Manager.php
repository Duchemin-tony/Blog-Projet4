<?php
class Manager
{
    const HOST_NAME = 'localhost:8889';
    const DATABASE = 'projet44';
    const USER_NAME = 'root';
    const PASSWORD = 'root';

    protected function bddConnect()
    {
        $bdd = new PDO('mysql:host='.self::HOST_NAME.';dbname='.self::DATABASE.'; charset=utf8', self::USER_NAME, self::PASSWORD);
        return $bdd;
    }
}