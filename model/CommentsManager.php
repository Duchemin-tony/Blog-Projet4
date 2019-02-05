<?php

class CommentsManager extends Manager 
{

    /**
    * Permet l'ajout d'un commentaire en BDD
    */
    public function add($comment)
    {
        $bdd = parent::bddConnect();
        $request = $bdd->prepare('INSERT INTO comments(content, creationDate, postId, idUser, alert) VALUES(:content, :creationDate, :postId, :idUser, :alert)');
        $request->bindValue(':content', $comment->content());
        $request->bindValue(':creationDate', $comment->creationDate());
        $request->bindValue(':postId', $comment->postId(), PDO::PARAM_INT);
        $request->bindValue(':idUser', $comment->idUser(), PDO::PARAM_INT);
        $request->bindValue(':alert', 0);
        $request->execute() or die(print_r($request->errorInfo(), TRUE));
    }

    /**
    * Permet de supprimer un commentaire en BDD
    */
    public function delete($id)
    {
        $bdd = parent::bddConnect();
        $request = $bdd->prepare('DELETE FROM comments WHERE id = :id');
        $request->bindValue(':id', $id, PDO::PARAM_INT);
        $request->execute() or die(print_r($request->errorInfo(), TRUE));
    }

    /**
    * Permet la suppression des commentaires d'un article
    */
    public function deleteCommentPost($postId)
    {
        $bdd = parent::bddConnect();
        $request = $bdd->prepare('DELETE FROM comments WHERE postId = :postId');
        $request->bindValue(':postId', $postId, PDO::PARAM_INT);
        $request->execute() or die(print_r($request->errorInfo(), TRUE));
    }

    /**
    * Permet de récupérer les commentaires signalé
    */
    public function getListCommentsAlert()
    {
        $bdd = parent::bddConnect();

        $request = $bdd->query('SELECT com.id idComment, DATE_FORMAT(com.creationDate, \'%d-%m-%Y à %Hh%i\') AS creationDateComment, com.content contentComment, com.alert alertComment, m.pseudo pseudoUser, t.title titlePost, com.postId postId FROM comments com INNER JOIN users m ON com.idUser = m.id INNER JOIN posts t ON com.postId = t.id WHERE com.alert = TRUE');
        $comment = $request->fetchAll();
        for($i = 0; $i < count($comment); $i++)
        {
            $comment[$i] = new CommentsJoin($comment[$i]);
        }

        return $comment;
    }

    /**
    * Récupère tous les commentaires d'un article
    */
    public function getListCommentsPost($id)
    {
        $bdd = parent::bddConnect();

        $request = $bdd->prepare('SELECT com.id idComment, DATE_FORMAT(com.creationDate, \'%d-%m-%Y à %Hh%i\') AS creationDateComment, com.content contentComment, com.alert alertComment, m.pseudo pseudoUser, t.title titlePost FROM comments com INNER JOIN users m ON com.idUser = m.id INNER JOIN posts t ON com.postId = t.id WHERE com.postId = :postId ORDER BY com.alert DESC, com.creationDate DESC');
        $request->bindValue(':postId', $id, PDO::PARAM_INT);
        $request->execute() or die(print_r($request->errorInfo(), TRUE));
        $comment = $request->fetchAll();
        for($i = 0; $i < count($comment); $i++)
        {
            $comment[$i] = new CommentsJoin($comment[$i]);
        }
        return $comment;
    }

    /**
    * Récupère le nbr de commentaire de chaque article
    */
    public function getNbrComments($id)
    {
        $bdd = parent::bddConnect();

        $request = $bdd->prepare('SELECT COUNT(*) AS nbrComments FROM comments WHERE postId = :postId');
        $request->bindValue(':postId', $id, PDO::PARAM_INT);
        $request->execute() or die(print_r($request->errorInfo(), TRUE));
        $dataNbr = $request->fetch();
        return $dataNbr['nbrComments'];
    }

    /**
    * Permet le signalement d'un commentaire en BDD
    */
    public function reportComment($id)
    {
        $bdd = parent::bddConnect();
        $request = $bdd->prepare('UPDATE comments SET alert = TRUE WHERE id = :id');
        $request->bindValue(':id', $id, PDO::PARAM_INT);
        $request->execute() or die(print_r($request->errorInfo(), TRUE));
    }

    /**
    * Permet d'approuver le commentaire en BDD
    */
    public function approb($id)
    {
        $bdd = parent::bddConnect();

        $request = $bdd->prepare('UPDATE comments SET alert = FALSE WHERE id = :id');
        $request->bindValue(':id', $id, PDO::PARAM_INT);
        $request->execute() or die(print_r($request->errorInfo(), TRUE));
    }
}
