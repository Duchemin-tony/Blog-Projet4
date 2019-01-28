<?php

namespace Blog\model;

require_once('model/Manager.php');

class CommentManager extends Manager
{
	public function getComments($postId)
	{
		$db = $this->dbConnect();
		$comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS commentDate_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
    	$comments->execute(array($postId));

    	return $comments;
	}

	public function postComment($postId, $author, $comment)
	{
		$db = $this->dbConnect();
		$comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES (?, ?, ?, NOW())');
		$affectedLines = $comments->execute(array($postId, $author, $comment));

		return $affectedLines;
	}	


	public function editComment($id, $comment)
	{
		$db = $this->dbConnect();
		$newComments = $db->prepare('UPDATE comments SET comment=? WHERE id=?');
		$affectedComment = $newComments->execute(array($comment, $id));

		return $affectedComment;
	}
}
