<?php
session_start();

require_once('controller/frontend.php');
require_once('controller/backend.php');

try {
    if (isset($_POST['login'])) {
        login();
    }
    elseif (isset($_GET['admin']) && $_GET['admin'] == 'logout') {
        logout();
    }

    if (isset($_GET['action'])) {

        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'post') {

            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $exist = checkPost($_GET['id']);

                if($exist['post_exist']){
                    post($_GET['id']);
                }
                else {
                    throw new Exception('L\'article que vous cherchez n\'existe pas.');
                }
            }
            else {
                throw new Exception('Aucun identifiant d\'article envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {

            if (isset($_GET['id']) && $_GET['id'] > 0) {

                if (!empty($_POST['author']) && !empty($_POST['comment']) && trim($_POST['author']) != '' && trim($_POST['comment']) != '') {
                    $exist = checkPost($_GET['id']);

                    if ($exist['post_exist']) {
                        addComment($_GET['id'], htmlspecialchars($_POST['author']), htmlspecialchars($_POST['comment']));
                    }
                    else {
                        throw new Exception('Impossible d\'ajouter votre commentaire !');
                    }
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant d\'article envoyé');
            }
        }
        elseif ($_GET['action'] == 'report') {

            if ((isset($_GET['post_id']) && $_GET['post_id'] > 0) && (isset($_GET['comment_id']) && $_GET['comment_id'] > 0)) {
                $postExist = checkPost($_GET['post_id']);

                if ($postExist['post_exist']) {
                    $commentExist = checkComment($_GET['comment_id']);

                    if ($commentExist['comment_exist']) {
                        report($_GET['comment_id'], $_GET['post_id']);
                    }
                    else{
                        throw new Exception('Impossible de signaler le commentaire');
                    }

                }
                else{
                    throw new Exception('Impossible de signaler le commentaire !');
                }
            }
            else {
                throw new Exception('Aucun identifiant d\'article et/ou de commentaire envoyé');
            }
        }
        elseif ($_GET['action'] == 'admin') {
            adminIndex();
        }
        elseif ($_GET['action'] == 'adminDeleteReport') {

            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $commentExist = checkComment($_GET['id']);

                if ($commentExist['comment_exist']) {
                    adminDeleteReport($_GET['id']);
                }
                else{
                    throw new Exception('Le commentaire que vous souhaitez supprimer n\'existe pas. Impossible de le supprimer !');
                }
                
            }
            else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        }
        elseif ($_GET['action'] == 'adminCancelReport') {

            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $exist = checkReport($_GET['id']);

                if ($exist['report_exist']) {
                    adminCancelReport($_GET['id']);
                }
                else{
                    throw new Exception('Le signalement que vous souhaitez annuler est introuvable.');
                }
            }
            else {
                throw new Exception('Aucun identifiant d\'article envoyé');
            }
        }
        elseif ($_GET['action'] == 'adminNewPost') {
            adminNewPost();
        }
        elseif ($_GET['action'] == 'adminAddPost') {
            adminAddPost();
        }
        elseif ($_GET['action'] == 'adminAllPosts') {
            adminAllPosts();
        }
        elseif ($_GET['action'] == 'adminChangePost') {

            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $exist = checkPost($_GET['id']);

                if ($exist['post_exist']) {
                    adminChangePost($_GET['id']);
                }
                else{
                    throw new Exception('L\'article que vous cherchez n\'existe pas.');
                }

            }
            else {
                throw new Exception('Aucun identifiant d\'article envoyé');
            }
        }
        elseif ($_GET['action'] == 'adminChangingPost') {

            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $exist = checkPost($_GET['id']);

                if ($exist['post_exist']) {
                    adminChangingPost($_GET['id']);
                }
                else{
                    throw new Exception('Impossible de mettre à jour l\'article car il n\'existe pas (ou plus).');
                }

            }
            else {
                throw new Exception('Aucun identifiant d\'article envoyé');
            }
        }
        elseif ($_GET['action'] == 'adminDeletePost') {

            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $exist = checkPost($_GET['id']);

                if ($exist['post_exist']) {
                    adminDeletePost($_GET['id']);
                }
                else{
                    throw new Exception('L\'article que vous cherchez n\'existe pas. Impossible de le supprimer !');
                }

            }
            else {
                throw new Exception('Aucun identifiant d\'article envoyé');
            }
        }else {
            throw new Exception('La page que vous cherchez n\'existe pas.');
        }  
 
    }
    else {
        listPosts();
    }
}
catch(Exception $e) {
    error($e);
}