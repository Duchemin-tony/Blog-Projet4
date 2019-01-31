<?php

class ControllerIndex
{
    private $_postManager;

    public function __construct()
    {
        $this->setPostManager(new PostManager());
    }

    public function callGetPosts()
    {
        $posts = $this->postManager()->getListPosts();
        for($i = 0; $i < count($posts); $i++)
        {
            $posts[$i]->setTitle(ucfirst($posts[$i]->title()));
        }
        $viewIndex = new View('accueil');
        $viewIndex->generate(array('posts' => $posts));
    }

    public function setPostManager($postManager) { $this->_postManager = $postManager; }

    public function postManager() { return $this->_postManager; }
}
