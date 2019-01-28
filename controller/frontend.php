<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function listPosts()
{
	$postManager = new Blog\model\PostManager();
	$posts = $postManager->getPosts();

	require('view/frontend/listPostsView.php');
}

function post()
{
	$postManager = new Blog\model\PostManager();
	$commentManager = new Blog\model\CommentManager();

	$post = $postManager->getPost($_GET['id']);
	$comments = $commentManager->getComments($_GET['id']);

	require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment)
{
	$commentManager = new \Blog\model\CommentManager();

	$affectedLines = $commentManager->postComment($postId, $author, $comment);

	if ($affectedLines === false) {
		throw new Exception('Impossible d\'ajouter le commentaire !');
	}
	else {
		header('Location: index.php?action=post&id=' . $postId);
	}

function edit($id, $comment, $postId)
{
    $commentManager = new Blog\model\CommentManager();
 
    $affectedcomment = $commentManager->editComment($id, $comment, $postId);
 
    if ($affectedcomment === false){
        throw new Exception('Impossible d\'editer le commentaire !');
    }
    else {
    	echo 'Commentaire : ' . $id;
        header('Location : index.php?action=post&id=' . $_GET['post']);
    }
}