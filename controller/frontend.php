<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/AdminManager.php');

function listPosts()
{
    $postManager = new \model\PostManager();
    $posts = $postManager->getPosts();

    require('view/frontend/listPostsView.php');
}

function post($postId)
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($postId);
    $comments = $commentManager->getComments($postId);
    $reporting = $commentManager->getReporting($postId);

    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function report($commentId, $postId)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->postReporting($commentId);

    if ($affectedLines === false) {
        throw new Exception('Impossible de signaler le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function error($e)
{
    require('view/frontend/errorView.php');
}

function checkPost($postId)
{
    $postId = intval($postId);
    $postManager = new PostManager();
    $check = $postManager->getCheckPost($postId);

    return $check;
}

function checkComment($commentId)
{
    $commentId = intval($commentId);
    $commentManager = new CommentManager();
    $check = $commentManager->getCheckComment($commentId);

    return $check;
}

function checkReport($reportId)
{
    $reportId = intval($reportId);
    $commentManager = new CommentManager();
    $check = $commentManager->getCheckReport($reportId);

    return $check;
}
