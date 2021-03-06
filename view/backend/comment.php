<?php

if(isset($comments[0])) {
    $this->setTitle('Commentaires : ' . $comments[0]->titlePost() . ' - Billet simple pour l\'Alaska');
} else {
    $this->setTitle('Aucun commentaires pour ce chapitre - Billet simple pour l\'Alaska');
} 
?>

<a href="administration"><button class="btn btn-primary">Voir la liste des articles</button></a>

<div style="padding-bottom: 50px; padding-top: 50px;">
    <h1><?= $titleSection; ?></h1>
        <table class="table">
            <thead>
                <tr>
                    <td>Auteur</td>
                    <td>Date</td>
                    <td class="content">Contenu</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                <?php if(count($comments) != 0){
                    for($i = 0; $i < count($comments); $i++) :
                        if(isset($_GET['postId'])) { $postId = $_GET['postId']; } else { $postId = $comments[$i]->postId(); } ?>
                <tr <?php if($comments[$i]->alertComment()) { ?><?php } else { ?><?php } ?>>
                    <td><?= $comments[$i]->pseudoUser(); ?></td>
                    <td><?= $comments[$i]->creationDateComment(); ?></td>
                    <td class="content"><?= $comments[$i]->contentComment(); ?></td>
                    <td>
                        <a class="btn btn-danger" href="admin.php?action=delete&deleteComment=on&idComment=<?= $comments[$i]->idComment(); ?>">Supprimer</a>
                        <a class="btn btn-primary" href="article-<?= $postId; ?>" target=_blank>Voir l'article</a>
                            <?php if($comments[$i]->alertComment()) { ?>
                        <a class="btn btn-warning" href="admin.php?action=comment&approb=on&id=<?= $comments[$i]->idComment(); ?>" title="Approuver le commentaire signaler">Approuver le commentaire</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php endfor; } else { echo 'Aucun commentaire n\'a encore était posté pour cette article !'; } ?>
            </tbody>
        </table>
