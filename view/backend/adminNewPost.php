<?php $title = 'Administration : Ajouter article'; ?>

<?php ob_start(); ?>

<h1>Ajouter un article</h1>

<form action="index.php?action=adminAddPost" method="post">
    <div>
        <label for="title">Titre de l'article</label><br />
        <input type="text" id="title" name="title" />
    </div>
    <div>
        <label for="chapterContent">Contenu de l'article</label><br />
        <textarea  id="chapterContent" name="chapterContent"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>

<p><a href="index.php?action=admin"><button>Retour</button></a></p>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?> 