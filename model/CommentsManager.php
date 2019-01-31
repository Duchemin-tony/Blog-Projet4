<?php

class CommentsManager extends Manager
{

    public function add($comment)
    {
        $bdd = parent::bddConnect();
        $request = $bdd->prepare('INSERT INTO comments(content, creation_date, post_id, id_user, alert) VALUES(:content, :creation_date, :post_id, :id_user, :alert)');
        $request->bindValue(':content', $comment->content());
        $request->bindValue(':creation_date', $comment->creationDate());
        $request->bindValue(':post_id', $comment->idPost(), PDO::PARAM_INT);
        $request->bindValue(':id_user', $comment->idUser(), PDO::PARAM_INT);
        $request->bindValue(':alert', 0);
        $request->execute() or die(print_r($request->errorInfo(), TRUE)); // or die permet d'afficher les erreurs de MySql
    }

    // Méthode de suppression d'un commentaire
    public function delete($id)
    {
        // Connexion à la BDD
        $bdd = parent::bddConnect();

        // Prépare la requète de suppression d'un commentaire
        $request = $bdd->prepare('DELETE FROM comments WHERE id = :id');
        $request->bindValue(':id', $id, PDO::PARAM_INT);
        // Execute la requète
        $request->execute() or die(print_r($request->errorInfo(), TRUE));
    }

    public function deleteCommentPost($idPost)
    {
        $bdd = parent::bddConnect();
        $request = $bdd->prepare('DELETE FROM comments WHERE post_id = :post_id');
        $request->bindValue(':post_id', $postId, PDO::PARAM_INT);
        $request->execute() or die(print_r($request->errorInfo(), TRUE));
    }

    public function getListCommentsAlert()
    {
        $bdd = parent::bddConnect();

        $request = $bdd->query('SELECT com.id id_comment, DATE_FORMAT(com.creation_date, \'%d-%m-%Y à %Hh%i\') AS creation_date, com.content content_comment, com.alert alert_comment, m.email mailUser, t.title titlePost, com.post_id idPost FROM comments com INNER JOIN users m ON com.id_user = m.id INNER JOIN posts t ON com.post_id = t.id WHERE com.alert = TRUE');
        $comment = $request->fetchAll();
        for($i = 0; $i < count($comment); $i++)
        {
            $comment[$i] = new CommentsJoin($comment[$i]);
        }

        return $comment;
    }

    public function getListCommentsPost($id)
    {
        $bdd = parent::bddConnect();

        $request = $bdd->prepare('SELECT com.id id_comment, DATE_FORMAT(com.creation_date, \'%d-%m-%Y à %Hh%i\') AS creation_date, com.content content_comment, com.alert alert_comment, m.email mailUser, t.title titlePost FROM comments com INNER JOIN users m ON com.id_user = m.id INNER JOIN posts t ON com.post_id = t.id WHERE com.post_id = :idPost ORDER BY com.alert DESC, com.creation_date DESC');
        $request->bindValue(':idPost', $id, PDO::PARAM_INT);
        $request->execute() or die(print_r($request->errorInfo(), TRUE));
        $comment = $request->fetchAll();
        for($i = 0; $i < count($comment); $i++)
        {
            $comment[$i] = new CommentsJoin($comment[$i]);
        }
        return $comment;
    }

    public function getNbrComments($id)
    {
        $bdd = parent::bddConnect();

        $request = $bdd->prepare('SELECT COUNT(*) AS nbr_comments FROM comments WHERE post_id = :post_id');
        $request->bindValue(':post_id', $id, PDO::PARAM_INT);
        $request->execute() or die(print_r($request->errorInfo(), TRUE));
        $dataNb = $request->fetch();
        return $dataNb['nbr_comments'];
    }

    public function reportComment($id)
    {
        $bdd = parent::bddConnect();
        $request = $bdd->prepare('UPDATE comments SET alert = TRUE WHERE id = :id');
        $request->bindValue(':id', $id, PDO::PARAM_INT);
        $request->execute() or die(print_r($request->errorInfo(), TRUE));
    }

    public function approb($id)
    {
        $bdd = parent::bddConnect();

        $request = $bdd->prepare('UPDATE comments SET alert = FALSE WHERE id = :id');
        $request->bindValue(':id', $id, PDO::PARAM_INT);
        $request->execute() or die(print_r($request->errorInfo(), TRUE));
    }
}
