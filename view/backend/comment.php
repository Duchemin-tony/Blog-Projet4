<?php

if(isset($comments[0]))
{
    $this->setTitle('Commentaires : ' . $comments[0]->titlePost() . ' - Billet simple pour l\'Alaska');
}
else
{
    $this->setTitle('Aucun commentaires pour ce chapitre - Billet simple pour l\'Alaska');
}
?>

<a href="admin.php">Voir la liste des articles</a>


<div>
    <h1><?= $titleSection; ?></h1>

    <?php
    if(count($comments) != 0)
    {
        for($i = 0; $i < count($comments); $i++) :

        if(isset($_GET['postId'])) { $postId = $_GET['postId']; } else { $postId = $comments[$i]->postId(); }
    ?>
        <div <?php if($comments[$i]->alertComment()) { ?>class="commentAlert"<?php } else { ?>class="comment"<?php } ?>>
            <div>
                <p>Poster par : <span><?= $comments[$i]->emailUser(); ?></span></p>
                <p>Poster le : <span><?= $comments[$i]->creationDateComment(); ?></span></p>
            </div>

            <div>
                <?= $comments[$i]->contentComment(); ?>
            </div>

            <ul>
                <li><a href="admin.php?action=delete&deleteComment=on&idComment=<?= $comments[$i]->idComment(); ?>">Supprimer</a></li>
                <li><a href="index.php?action=post&id=<?= $postId; ?>" target=_blank>Voir l'article'</a></li>
            <?php
            if($comments[$i]->alertComment())
            {
            ?>
                <li><a href="admin.php?action=comment&approb=on&id=<?= $comments[$i]->idComment(); ?>" title="Approuver le commentaire signaler">Approuver le commentaire</a></li>
            <?php
            }
            ?>
            </ul>
        </div>
    <?php
        endfor;
    }
    else
    {
        echo 'Aucun commentaire n\'a encore était poster pour cette article !';
    }
    ?>
</div>