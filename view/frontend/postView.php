<?php $this->setTitle($post->title() . ' - Billet simple pour l\'Alaska'); ?>

<h1>Billet simple pour l'Alaska</h1>
<p><a href="index.php"><button>Retour à la liste des articles</button></a></p>

<div class="news">
    <h2>
        <?= $post->title(); ?>

        <em>le <?= $post->creationDate(); ?></em>

        <?php if($post->modifDate() != NULL) { ?> 
            <em>Modifié le :<?= $post->modifDate(); ?></em> 
        <?php } ?>

    </h2>

    <?= $post->content(); ?>

</div>

<h3>Commentaires</h3>

<?php
        if(count($commentsPost) != 0)
        {
        ?>
            <div>
                <?php for($i = 0; $i < count($commentsPost); $i++) : ?>
                    <?php
                        if($commentsPost[$i]->alertComment() == 1)
                        {
                    ?>
                        <div>
                    <?php
                        }
                        else
                        {
                    ?>
                        <div>
                    <?php
                        }
                    ?>

                        <p>
                            <p>Poster par : <span class="strong"><?= $commentsPost[$i]->emailUser(); ?></span></p>
                            <p>Le : <span class="strong"><?= $commentsPost[$i]->creationDateComment(); ?></span></p>
                        </p>

                        <div class="contentComment">
                            <?= $commentsPost[$i]->contentComment(); ?>
                        </div>

                        <form action="index.php?action=post&id=<?= $_GET['id']; ?>" method="post">
                            <p>
                                <input type="hidden" name="idComment" value="<?= $commentsPost[$i]->idComment(); ?>">
                                <input type="hidden" name="reportComment" value="reportComment">
                                <?php
                                if($commentsPost[$i]->alertComment() == 1)
                                {
                                ?>
                                    <input type="submit" value="Commentaire signaler" disabled>
                                <?php
                                }
                                else
                                {
                                ?>
                                    <input type="submit" value="Signaler le commentaire">
                                <?php
                                }
                                ?>

                            </p>
                        </form>

                    </div>

                <?php endfor; ?>
            </div>
        <?php
        }
        else
        {
            echo 'Aucun commentaire n\'a était poster sur cette article';
        }
        ?>

    </article> <!-- /Affichage des commentaires -->

    <!-- Formulaire ajout commentaire -->
    <article>
        <h1>Laisser un commentaire :</h1>
        <form action="index.php?action=post&id=<?= $_GET['id']; ?>" method="post">

            <?php if(isset($_SESSION['errorPostComment'])) { echo '<p class="errorBlog">' . $_SESSION['errorPostComment'] . '</p>'; } ?>

            <div>

            <?php
            if(isset($_SESSION['email']))
            {
            ?>
                <p>
                    <label for="email">Votre pseudo:</label>
                    <input type="email" name="email" id="email" value="<?= $_SESSION['email']; ?>" disabled>
                    <input type="hidden" name="email" id="email" value="<?= $_SESSION['email']; ?>"> <!-- Champ qui sera transmis -->
                </p>
            <?php
            }
            else
            {
            ?>
                <p>
                    <label for="email">Votre pseudo:</label>
                    <input type="email" name="email" id="email">
                </p>

                <p>
                    <label for="password">Mot de passe :</label>
                    <input type="password" name="password" id="password">
                </p>
            <?php
            }
            ?>

            </div>

            <div>

                <p>
                    <label for="comment">Votre commentaire :</label><br>
                    <textarea name="comment"></textarea>
                </p>

            </div>

            <p>
                <input type="hidden" name="postId" value="<?= $_GET['id']; ?>">
                <input type="hidden" name="publicationComment" value="publicationComment">
                <input type="submit" value="Envoyer le commentaire">
            </p>
        </form>
    </article> 