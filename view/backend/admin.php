<?php

$this->setTitle('Administration - Billet simple pour l\'Alaska');
?>

<a href="admin.php?action=post">Ajouter un article</a>

<div> 

    <?php
    if($posts != null)
    {
        if($nbrCommentAlert != 0)
        {
        ?>
        <div>
            <form action="admin.php" method="get">
                <?php
                if($nbrCommentAlert == 1) 
                {
                ?>
                    <p><?= $nbrCommentAlert; ?> commentaire a était signaler</p>
                    <input type="hidden" name="action" value="comment"> 
                    <input type="hidden" name="alertComments" value="on">
                    <input type="submit" class="linkPage" value="Visualiser le commentaire">
                <?php
                }
                else 
                {
                ?>
                    <p><?= $nbrCommentAlert; ?> commentaires ont était signaler</p>
                    <input type="hidden" name="action" value="comment"> 
                    <input type="hidden" name="alertComments" value="on">
                    <input type="submit" value="Visualiser les commentaires">
                <?php
                }
                ?>
            </form>
        </div>
        <?php
        }
        ?>

    <div> 

        <form method="post" action="admin.php?action=delete">

            <div>

                <div>
                    <?php
                    for($i = 0; $i < count($posts); $i++) :
                    ?>
                        <div>

                            <div>
                                <input type="checkbox" name="postId[<?= $i; ?>]" id="postId" value="<?= $posts[$i]->id(); ?>">
                            </div>

                            <div>
                                <a href="admin.php?action=post&change=on&postId=<?= $posts[$i]->id(); ?>"><?= $posts[$i]->title(); ?></a>
                                <p><?= $posts[$i]->content(); ?></p>
                                <li><a href="admin.php?action=post&change=on&postId=<?= $posts[$i]->id(); ?>">Modifier</a></li>
                                <li><a href="admin.php?action=delete&deletePost=on&postId=<?= $posts[$i]->id(); ?>">Supprimer</a></li>
                                <li><a href="admin.php?action=comment&comment=on&postId=<?= $posts[$i]->id(); ?>">Afficher commentaire(s)</a></li>
                            </div>
                            <div>
                                <?= $posts[$i]->creationDate(); ?> 
                            </div>
                            <div>
                                <?= $nbrComments[$i]; ?> Commentaire(s)
                            </div>
                        </div>

                    <?php endfor; ?> 

                </div> 
            </div> 

            <input type="hidden" name="deletePost" value="on"> 
            <input type="submit" value="Supprimer"> 
        </form>

    </div> 
    <?php
    }
    else
    {
        echo 'Votre Blog ne contient encore aucun article';
    }
    ?>

</div>