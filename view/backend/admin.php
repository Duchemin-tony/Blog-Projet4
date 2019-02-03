<?php $this->setTitle('Administration - Billet simple pour l\'Alaska'); ?>

<a href="admin.php?action=post"><button type="submit" class="btn btn-success">Ajouter un article</button></a>


    <?php if($posts != null) { if($nbrCommentAlert != 0) { ?>
        <div>
            <form action="admin.php" method="get" style="padding-bottom: 50px; padding-top: 50px;">
                <?php if($nbrCommentAlert == 1) { ?>
                    <p><?= $nbrCommentAlert; ?> commentaire a était signaler</p>
                    <input type="hidden" name="action" value="comment"> 
                    <input type="hidden" name="alertComments" value="on">
                    <button type="submit" class="btn btn-primary">Visualiser le commentaire</button>
                <?php } else { ?>
                    <p><?= $nbrCommentAlert; ?> commentaires ont était signaler</p>
                    <input type="hidden" name="action" value="comment"> 
                    <input type="hidden" name="alertComments" value="on">
                    <button type="submit" class="btn btn-primary">Visualiser les commentaires</button>
                <?php } ?>
            </form>
        </div>
        <?php } ?>

    <table class="table">
    <thead>
    <tr>
        <td>Titre</td>
        <td>Date</td>

        <td>Commentaires</td>
        <td>Actions</td>
    </tr>
    </thead>
    <tbody>
        <?php for($i = 0; $i < count($posts); $i++): ?>
        <tr>
            <td><a href="admin.php?action=post&change=on&postId=<?= $posts[$i]->id(); ?>"><?= $posts[$i]->title(); ?></a></td>
            <td><?= $posts[$i]->creationDate(); ?> </td>
 
            <td><?= $nbrComments[$i]; ?> Commentaire(s)</td>
            <td>
                <a class="btn btn-warning" href="admin.php?action=post&change=on&postId=<?= $posts[$i]->id(); ?>">Modifier</a>
                <a class="btn btn-danger" href="admin.php?action=delete&deletePost=on&postId=<?= $posts[$i]->id(); ?>">Supprimer</a>
                <a class="btn btn-primary" href="admin.php?action=comment&comment=on&postId=<?= $posts[$i]->id(); ?>">Afficher commentaire(s)</a>
            </td>
        </tr>
        <?php endfor; ?>
    </tbody>
</table>
<?php } else { echo 'Votre Blog ne contient encore aucun article'; } ?>


