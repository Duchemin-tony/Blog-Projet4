<?php
class View
{
    private $_file;

    private $_title;

    public function __construct($action)
    {
        $this->setFile("view/backend/" . $action . ".php");
    }

    public function generate($data)
    {
        $content = $this->generateFile($this->file(), $data);
        $view = $this->generateFile('view/backend/template.php', array(
            'title' => $this->title(),
            'content' => $content
        ));
        echo $view;
    }

    private function generateFile($file, $data)
    {
        if(file_exists($file))
        {
            extract($data);
            ob_start();
            require $file;
            return ob_get_clean();
        }
        else {
            throw new Exception('Fichier ' . $file . ' introuvale');
        }
    }

    public function setTitle($title) { $this->_title = $title; }
    public function title() { return $this->_title; }

    public function setFile($file) { $this->_file = $file; }
    public function file() { return $this->_file; }
}
