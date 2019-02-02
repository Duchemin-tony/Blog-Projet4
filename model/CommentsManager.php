<?php

class CommentsManager extends Manager 
{

    public function add($comment)
    {
        $bdd = parent::bddConnect();
        $request = $bdd->prepare('INSERT INTO comments(content, creationDate, postId, idUser, alert) VALUES(:content, :creationDate, :postId, :idUser, :alert)');
        $request->bindValue(':content', $comment->content());
        $request->bindValue(':creationDate', $comment->creationDate());
        $request->bindValue(':postId', $comment->postId(), PDO::PARAM_INT);
        $request->bindValue(':idUser', $comment->idUser(), PDO::PARAM_INT);
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

    public function deleteCommentPost($postId)
    {
        $bdd = parent::bddConnect();
        $request = $bdd->prepare('DELETE FROM comments WHERE postId = :postId');
        $request->bindValue(':postId', $postId, PDO::PARAM_INT);
        $request->execute() or die(print_r($request->errorInfo(), TRUE));
    }

    public function getListCommentsAlert()
    {
        $bdd = parent::bddConnect();

        $request = $bdd->query('SELECT com.id idComment, DATE_FORMAT(com.creationDate, \'%d-%m-%Y à %Hh%i\') AS creationDateComment, com.content contentComment, com.alert alertComment, m.email emailUser, t.title titlePost, com.postId postId FROM comments com INNER JOIN users m ON com.idUser = m.id INNER JOIN posts t ON com.postId = t.id WHERE com.alert = TRUE');
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

        $request = $bdd->prepare('SELECT com.id idComment, DATE_FORMAT(com.creationDate, \'%d-%m-%Y à %Hh%i\') AS creationDateComment, com.content contentComment, com.alert alertComment, m.email emailUser, t.title titlePost FROM comments com INNER JOIN users m ON com.idUser = m.id INNER JOIN posts t ON com.postId = t.id WHERE com.postId = :postId ORDER BY com.alert DESC, com.creationDate DESC');
        $request->bindValue(':postId', $id, PDO::PARAM_INT);
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

        $request = $bdd->prepare('SELECT COUNT(*) AS nbrComments FROM comments WHERE postId = :postId');
        $request->bindValue(':postId', $id, PDO::PARAM_INT);
        $request->execute() or die(print_r($request->errorInfo(), TRUE));
        $dataNbr = $request->fetch();
        return $dataNbr['nbrComments'];
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
