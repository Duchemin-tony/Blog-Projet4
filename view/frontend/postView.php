<?php $this->setTitle($post->title() . ' - Billet simple pour l\'Alaska'); ?>

<p><a href="index.php"><button class="btn btn-primary">Retour à la liste des articles</button></a></p>

<div class="jumbotron">
    <h1><?= $post->title(); ?></h1>
            <em> Ajouté le <?= $post->creationDate(); ?></em>
        <?php if($post->modifDate() != NULL) { ?> 
            <em> Modifié le : <?= $post->modifDate(); ?></em><br>
        <?php } ?>
    <?= $post->content(); ?>
</div>
<div>
<h2>Commentaires:</h2>
        <?php
        if(count($commentsPost) != 0) { ?>
            <div>
                <?php for($i = 0; $i < count($commentsPost); $i++) : ?>
                    <?php if($commentsPost[$i]->alertComment() == 1) { ?>
                        <div>
                    <?php } else { ?>
                        <div>
                    <?php } ?>
    <div class='container'>
         <div class="media comment-box">
            <div class="media-left">
                <a href="#">
                    <img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading"><?= $commentsPost[$i]->pseudoUser(); ?> Posté le <?= $commentsPost[$i]->creationDateComment(); ?></h4>
                <?= $commentsPost[$i]->contentComment(); ?>
                    <form action="index.php?action=post&id=<?= $_GET['id']; ?>" method="post">
                        <input type="hidden" name="idComment" value="<?= $commentsPost[$i]->idComment(); ?>">
                        <input type="hidden" name="reportComment" value="reportComment">
                            <?php if($commentsPost[$i]->alertComment() == 1) { ?>
                        <button type="submit" class="btn btn-danger" disabled>Commentaire signaler</button>
                            <?php } else { ?>
                        <button type="submit" class="btn btn-danger">Signaler</button>
                            <?php } ?>
                    </form>
            </div>
        </div>
    </div>

    <?php endfor; ?>
    </div>
        <?php } else { echo 'Aucun commentaire n\'a était poster sur cette article'; } ?>
    </div>
    <div class="jumbotron">
        <h2>Laisser un commentaire:</h2>
            <form action="index.php?action=post&id=<?= $_GET['id']; ?>" method="post">
                <?php if(isset($_SESSION['errorPostComment'])) { echo '<p class="errorBlog">' . $_SESSION['errorPostComment'] . '</p>'; } ?>
                <div>
                    <?php if(isset($_SESSION['pseudo'])) { ?>
                    <p>
                        <label for="pseudo">Votre pseudo:</label>
                        <input type="text" name="pseudo" id="pseudo" value="<?= $_SESSION['pseudo']; ?>" disabled>
                        <input type="hidden" name="pseudo" id="pseudo" value="<?= $_SESSION['pseudo']; ?>"> 
                    </p>
                        <?php } else { ?>
                    <p>
                        <label for="pseudo">Votre pseudo:</label>
                        <input type="text" name="pseudo" id="pseudo">
                    </p>
                    <p>
                        <label for="password">Mot de passe :</label>
                        <input type="password" name="password" id="password">
                    </p>
                        <?php } ?>
                </div>
                <div>
                    <p>
                        <label for="comment">Votre commentaire:</label><br>
                        <textarea name="comment"></textarea>
                    </p>
                </div>
                <p>
                    <input type="hidden" name="postId" value="<?php echo $_GET['id']; ?>">
                    <input type="hidden" name="publicationComment" value="publicationComment">
                    <button type="submit" class="btn btn-success">Ajouter commentaire</button>
                </p>
            </form>
    </div>