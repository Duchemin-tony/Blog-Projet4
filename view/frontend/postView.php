<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<h1>Billet simple pour l'Alaska</h1>
<p><a href="index.php"><button>Retour à la liste des articles</button></a></p>

<div class="news">
    <h2>
        <?= htmlspecialchars($post['title']) ?>
        <em>le <?= $post['creation_date_fr'] ?></em>
    </h2>

    <?= nl2br($post['content']) ?>

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
        <p class="red">Ce commentaire a déjà été signalé. Il sera traité par l'administrateur au plus vite.</p>
    <?php
    }
    else{
    ?>
        <p><a href="index.php?action=report&amp;comment_id=<?= $comment['id'] ?>&amp;post_id=<?= $comment['post_id'] ?>"><button class="reporting">Signaler</button></a></p>
    <?php 
    }
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?> 