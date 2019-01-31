<?php

class PostManager extends Manager
{
    public function add($post)
    {
        $bdd = parent::bddConnect(); 
        $request = $bdd->prepare('INSERT INTO posts(title, content, creation_date) VALUES(:title, :content, :creation_date)');
        $request->bindValue(':title', $post->title());
        $request->bindValue(':content', $post->content());
        $request->bindValue(':creation_date', $post->creationDate());
        $request->execute() or die(print_r($request->errorInfo(), TRUE));
    }

    public function update($post)
    {
        $bdd = parent::bddConnect();
        $request = $bdd->prepare('UPDATE posts SET title = :newTitle, content = :newContent, modif_date = :new_modif_date WHERE id = :post_id');
        $request->bindValue(':post_id', $post->id(), PDO::PARAM_INT);
        $request->bindValue(':newTitle', $post->title());
        $request->bindValue(':newContent', $post->content());
        $request->bindValue(':new_modif_date', $post->modifDate());
        $request->execute() or die(print_r($request->errorInfo(), TRUE));
    }

    public function delete($id)
    {
        $bdd = parent::bddConnect();
        $request = $bdd->prepare('DELETE FROM posts WHERE id = :post_id');
        $request->bindValue(':post_id', $id, PDO::PARAM_INT);
        $request->execute() or die(print_r($request->errorInfo(), TRUE));
    }

    public function getPost($id)
    {
        $bdd = parent::bddConnect();
        $request = $bdd->prepare('SELECT title, content, DATE_FORMAT(creation_date, \'%d-%m-%Y à %Hh%i\') AS creation_date, DATE_FORMAT(modif_date, \'%d-%m-%Y à %Hh%i\') AS modif_date FROM posts WHERE id = :id');
        $request->bindValue(':id', $id, PDO::PARAM_INT);
        $request->execute() or die(print_r($request->errorInfo(), TRUE)); 
        $data = $request->fetch(); 
        $post = new Post($data);
        return $post; 
    }

    public function getListPosts()
    {
        $bdd = parent::bddConnect();
        $request = $bdd->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d-%m-%Y à %Hh%i\') AS creation_date FROM posts ORDER BY creation_date DESC') or die(print_r($request->errorInfo(), TRUE));
        $data = $request->fetchAll();
        for($i = 0; $i < count($data); $i++)
        {
            $post[$i] = new Post($data[$i]);
        }
        return $post;
    }
}
