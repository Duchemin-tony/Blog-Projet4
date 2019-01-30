<?php $title = 'Partie Administrateur : Nouveau Chapitre'; ?>

<?php ob_start(); ?>

<h1>Edition d'un nouveau Chapitre</h1>

<form action="index.php?action=adminAddPost" method="post">
    <div>
        <label for="title">Titre du chapitre</label><br />
        <input type="text" id="title" name="title" />
    </div>
    <div>
        <label for="chapterContent">Contenu du chapitre</label><br />
        <textarea  id="chapterContent" name="chapterContent"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>

<p><a href="index.php?action=admin"><button>Retour</button></a></p>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?> 