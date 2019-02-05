<?php $this->setTitle('Billet simple pour l\'Alaska'); ?>

    <div class="jumbotron">
        <h1> Bienvenue sur le blog de Jean Forteroche</h1>
        <p>A quibus propter discendi cupiditatem videmus ultimas terras esse peragratas. Ne in odium veniam, si amicum destitero tueri. Sed residamus, inquit, si placet. Scisse enim te quis coarguere possit? Non enim iam stirpis bonum quaeret, sed animalis. Quae cum essent dicta, finem fecimus et ambulandi et disputandi.</p>
    </div>
    <div class="album py-5 bg-light">
        <div class="container ">
            <h2 class="title-publication">Dernières publications :</h2>
            <div class="row">
            <?php
                for($i = 0; $i < count($posts); $i++): ?>
                <div class="col-lg-6 col-md-4">
                    <div class="card mb-2 box-shadow">
                        <img class="card-img-top" src="public/images/alaska.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?= $posts[$i]->title(); ?></h5>
                            <p class="card-text"><?= nl2br(substr($posts[$i]->content(), 0, 500)); ?> ...</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a class="btn btn-primary" href="index.php?action=post&id=<?= $posts[$i]->id(); ?>" role="button">Voir la suite</a>
                                <small class="text-muted"><?= $posts[$i]->creationDate(); ?></small>
                            </div>
                        </div>
                    </div>
                 </div>
               <?php endfor; ?> 
            </div>
        </div>
    </div>