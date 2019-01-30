<?php $title = 'Tous les chapitres'; ?>

<?php ob_start(); ?>
<h1>Tous les articles</h1>
<p><a href="index.php?action=admin"><button>Retour</button></a></p>
<p>Choisissez l'article à modifier</p>

<?php
while ($data = $posts->fetch())
{
?>
    <div class="news">
        <h2>
            <?= htmlspecialchars($data['title']) ?>
            <em>le <?= $data['creation_date_fr'] ?></em>
        </h2>

         <p><em><a href="index.php?action=adminChangePost&amp;id=<?= $data['id'] ?>">Modifier</a></em> <em><a href="index.php?action=adminDeletePost&amp;id=<?= $data['id'] ?>">Supprimer</a></em></p>
    </div>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php')