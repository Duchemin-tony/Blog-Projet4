<?php $title = 'Partie Administrateur'; ?>

<?php ob_start(); ?>

<h1>Bienvenue dans la partie Administrateur</h1>

<h2>Commentaires signalés</h2>

<?php
while ($report = $reporting->fetch())
{ ?>
    <p>Signalé le <?= $report['reporting_date'] ?> : <?= $report['comment'] ?> <a href="index.php?action=adminDeleteReport&amp;id=<?= $report['comment_id'] ?>" class="red">[X]</a> <a href="index.php?action=adminCancelReport&amp;id=<?= $report['comment_id'] ?>" class="green">[V]</a></p>

<?php
} ?>

<h2>Gestion du livre</h2>
<a href="index.php?action=adminNewPost"><button>Nouveau Chapitre</button></a>
<a href="index.php?action=adminAllPosts"><button>Voir tous les Chapitres</button></a>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?> 
  
