<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<h1>Modification</h1>
<p><a href="index.php?action=adminAllPosts"><button>Retour</button></a></p>
<p><a href="index.php?action=adminDeletePost&amp;id=<?= $post['id'] ?>"><button>Supprimer</button></a></p>
<div class="news">
    <form action="index.php?action=adminChangingPost&amp;id=<?= $post['id'] ?>" method="post">
        <div>
            <label for="title">Titre du chapitre</label><br />
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($post['title']) ?>"/>
        </div>
        <div>
            <label for="chapterContent">Contenu du chapitre</label><br />
            <textarea  id="chapterContent" name="chapterContent"><?= nl2br($post['content']) ?></textarea>
        </div>
        <div>
            <input type="submit" />
        </div>
    </form>



</div>

<h3>Commentaires</h3>

<form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>

<?php $i=0;
while ($report = $reporting->fetch())
{
    $comments_report[$i] = $report['comment_id'];
    $i++;
}
while ($comment = $comments->fetch())
{
?>
    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>

     <?php 
    $message_report=false;
    if (isset($comments_report)){
        for ($i=0 ; $i<count($comments_report) ; $i++){
            if ($comments_report[$i] == $comment['id'])
            {
                $message_report=true;
            }
        }
    }
    
    if (isset($message_report) && $message_report == true)
    { ?>
        <p class="red">Ce commentaire a été signalé !</p>
    <?php
    } ?>
    <a href="index.php?action=adminDeleteReport&amp;id=<?= $comment['id'] ?>" class="red"><p>[X]</p></a>
<?php 
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>