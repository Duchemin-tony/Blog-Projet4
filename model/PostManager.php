<?php

class PostManager extends Manager
{

    /**
    * Ajout d'un article 
    */
    public function add($post)
    {
        $bdd = parent::bddConnect(); 
        $request = $bdd->prepare('INSERT INTO posts(title, content, creationDate) VALUES(:title, :content, :creationDate)');
        $request->bindValue(':title', $post->title());
        $request->bindValue(':content', $post->content());
        $request->bindValue(':creationDate', $post->creationDate());
        $request->execute() or die(print_r($request->errorInfo(), TRUE));
    }

    /**
    * Permet la modification d'un article 
    */
    public function update($post)
    {
        $bdd = parent::bddConnect();
        $request = $bdd->prepare('UPDATE posts SET title = :newTitle, content = :newContent, modifDate = :newModifDate WHERE id = :postId');
        $request->bindValue(':postId', $post->id(), PDO::PARAM_INT);
        $request->bindValue(':newTitle', $post->title());
        $request->bindValue(':newContent', $post->content());
        $request->bindValue(':newModifDate', $post->modifDate());
        $request->execute() or die(print_r($request->errorInfo(), TRUE));
    }

    /**
    * Permet de supprimer un article 
    */
    public function delete($id)
    {
        $bdd = parent::bddConnect();
        $request = $bdd->prepare('DELETE FROM posts WHERE id = :postId');
        $request->bindValue(':postId', $id, PDO::PARAM_INT);
        $request->execute() or die(print_r($request->errorInfo(), TRUE));
    }

    /**
    * Récupère un article
    */
    public function getPost($id)
    {
        $bdd = parent::bddConnect();
        $request = $bdd->prepare('SELECT title, content, DATE_FORMAT(creationDate, \'%d-%m-%Y à %Hh%i\') AS creationDate, DATE_FORMAT(modifDate, \'%d-%m-%Y à %Hh%i\') AS modifDate FROM posts WHERE id = :id ORDER BY creationDate ');
        $request->bindValue(':id', $id, PDO::PARAM_INT);
        $request->execute() or die(print_r($request->errorInfo(), TRUE)); 
        $data = $request->fetch(); 
        $post = new Post($data);
        return $post; 
    }

    /**
    * Récupère tous les articles
    */
    public function getListPosts()
    {
        $bdd = parent::bddConnect();
        $request = $bdd->query('SELECT id, title, content, DATE_FORMAT(creationDate, \'%d-%m-%Y à %Hh%i\') AS creationDate FROM posts ORDER BY creationDate DESC') or die(print_r($request->errorInfo(), TRUE));
        $data = $request->fetchAll();
        for($i = 0; $i < count($data); $i++)
        {
            $post[$i] = new Post($data[$i]);
        }
        return $post;
    }
}
