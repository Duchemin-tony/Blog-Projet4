<?php 

use \model\Manager;

class AdminManager extends Manager
{
    public function getReportingAdmin()
    {
        $db = $this->dbConnect();
        $reporting = $db->prepare('SELECT * FROM posts AS p INNER JOIN comments AS c ON c.post_id = p.id INNER JOIN reporting AS r ON c.id = r.comment_id');
        $reporting->execute();
        return $reporting;
    }
    public function setDeleteReport($commentId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('DELETE FROM comments WHERE id = ?');
        $deleteComment = $comments->execute(array($commentId));
        if ($deleteComment === false) {
            throw new Exception('Impossible de supprimer le commentaire !');
        }
        else {
            $reporting = $db->prepare('DELETE FROM reporting WHERE comment_id = ?');
            $deleteReporting = $reporting->execute(array($commentId));
            return $deleteReporting;
        }
    }
    public function setCancelReport($commentId)
    {
        $db = $this->dbConnect();
        $reporting = $db->prepare('DELETE FROM reporting WHERE comment_id = ?');
        $deleteReporting = $reporting->execute(array($commentId));
        return $deleteReporting;
    }
    public function setNewPost()
    {
        $db = $this->dbConnect();
        $reporting = $db->prepare('INSERT INTO posts(title, content, creation_date) VALUES (?, ?, NOW())');
        $affectedLines = $reporting->execute(array($_POST['title'], $_POST['chapterContent']));
        return $affectedLines;
    }
    public function setChangePost($postId)
    {
        $db = $this->dbConnect();
        $reporting = $db->prepare('UPDATE posts SET title = ?, content=? WHERE `posts`.`id` = ?');
        $affectedLines = $reporting->execute(array($_POST['title'], $_POST['chapterContent'], $postId));
        return $affectedLines;
    }
    public function setDeletePost($postId)
    {
        $db = $this->dbConnect();
        $reporting = $db->prepare('DELETE FROM posts WHERE id = ?');
        $affectedLines = $reporting->execute(array($postId));
        if ($affectedLines === false) {
            throw new Exception('Impossible de supprimer le commentaire !');
        }
        else {
            $comments = $db->prepare('SELECT * FROM comments WHERE post_id = ?');
            $comments->execute(array($postId));
            while ($comment = $comments->fetch())
            {
                $deleteComments= $this->setDeleteReport($comment['id']);
            }
            return $deleteComments;
        }
    }
} 