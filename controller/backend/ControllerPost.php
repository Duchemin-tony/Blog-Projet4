<?php

class ControllerPost
{
    private $_postManager;

    public function __construct()
    {
        $this->setPostManager(new PostManager());
    }

    public function post($get)
    {
        $view = new View('post');
        if((isset($get['postId']) && (isset($get['change']) && ($get['change'] == 'on')))) 
        {
            $titlePage['titleSection'] = 'Modification d\'un article existant'; 
            $titlePage['titlePost'] = 'Titre d\'article :'; 
            $titlePage['labelContentPost'] = 'Contenu de l\'article :'; 
            $titlePage['buttonSend'] = 'Modifier l\'article '; 
            $postId = intval($get['postId']);
            if($postId != 0)
            {
                $post = $this->postManager()->getPost($postId);
                $view->setTitle('Modification du l\'article : ' . $post->title() . ' - Billet simple pour l\'Alaska'); 
            }
            else
            {
                throw new Exception("Identifiant de l'article incorrect");
            }
        }
        else {
            $post = null;
            $view->setTitle('Ajout d\'un nouvel article - Billet simple pour l\'Alaska');
            $titlePage['titleSection'] = 'Ajout d\'un nouvel article'; 
            $titlePage['titlePost'] = 'Titre du nouvel article :'; 
            $titlePage['labelContentPost'] = 'Contenu du nouvel article :'; 
            $titlePage['buttonSend'] = 'Ajouter l\'article'; 
        }
        $view->generate(array(
            'post' => $post,
            'titlePage' => $titlePage
        ));
    }

    public function decisionPost($post)
    {
        date_default_timezone_set('Europe/Monaco'); 
        $dateTime = date("Y-m-d H:i:s"); 

        if(isset($post['addPost']) && ($post['addPost'] == 'add'))
        {
            $dataPost = [
                'title' => $post['titlePost'],
                'content' => $post['contentPost'],
                'creationDate' => $dateTime,
            ];
            $post = new Post($dataPost);
            $this->postManager()->add($post);
        }
        else if(isset($post['change']) && ($post['change'] == 'on')) 
        {
            $dataPost = [
                'id' => $post['postId'],
                'title' => $post['titlePost'],
                'content' => $post['contentPost'],
                'modifDate' => $dateTime,
            ];
            $post = new Post($dataPost);
            $this->postManager()->update($post);
        }
        header('Location:admin.php');
    }

    public function setPostManager($postManager) { $this->_postManager = $postManager; }
    public function postManager() { return $this->_postManager; }
}
