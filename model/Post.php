<?php

class Post extends Hydrator
{
    private $_id;
    private $_title;
    private $_content;
    private $_creationDate;
    private $_modifDate;

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

    public function setTitle($title)
    {
        if(!is_string($title))
        {
            trigger_error("Le titre de l'article doit être une chaine de caractères", E_USER_WARNING);
            return;
        }

        $this->_title = $title;
    }

    public function setContent($content)
    {
        if(!is_string($content))
        {
            trigger_error("Le contenu de l'article doit être une chaine de caractères", E_USER_WARNING);
            return;
        }

        $this->_content = $content;
    }

    public function setCreationDate($creationDate)
    {
        $this->_creationDate = $creationDate;
    }

    public function setModifDate($modifDate)
    {
        $this->_modifDate = $modifDate;
    }

    public function id()
    {
        return $this->_id;
    }

    public function title()
    {
        return $this->_title;
    }

    public function content()
    {
        return $this->_content;
    }

    public function creationDate()
    {
        return $this->_creationDate;
    }

    public function modifDate()
    {
        return $this->_modifDate;
    }
}
