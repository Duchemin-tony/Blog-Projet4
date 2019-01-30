<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
    <div class="album py-5 bg-light">
        <div class="container">
            <h1 class="title-publication">Dernières publications :</h1>
            <div class="row">
            <?php
            while ($data = $posts->fetch()) 
            {
            ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="public/alaska.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?= $data['title'] ?></h5>
                            <p class="card-text"><?= nl2br(substr($data['content'], 0, 250)) ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a class="btn btn-primary" href="index.php?action=post&amp;id=<?= $data['id'] ?>" role="button">Voir la suite</a>
                                <small class="text-muted"><?= $data['creation_date_fr'] ?></small>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                $posts->closeCursor();
                ?>
            </div>
        </div>
    </div>
</main>
<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>