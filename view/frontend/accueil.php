<?php $this->setTitle('Billet simple pour l\'Alaska'); ?>

    <div class="jumbotron">
        <h1> Bienvenue sur le blog de Jean Forteroche</h1>
        <p>A quibus propter discendi cupiditatem videmus ultimas terras esse peragratas. Ne in odium veniam, si amicum destitero tueri. Sed residamus, inquit, si placet. Scisse enim te quis coarguere possit? Non enim iam stirpis bonum quaeret, sed animalis. Quae cum essent dicta, finem fecimus et ambulandi et disputandi.</p>
    </div>
        <div class="container">
            <h2 class="title-publication">Dernières publications:</h2>
            <?php
                for($i = 0; $i < count($posts); $i++): ?>
                <div class="col-lg-12">
                    <div class="card mb-2 box-shadow">
                        <div class="card-body">
                            <h5 class="card-title"><?= $posts[$i]->title(); ?></h5>
                            <p><small class="text-muted"><?= $posts[$i]->creationDate(); ?></small></p>
                            <p class="card-text"><?= nl2br(substr($posts[$i]->content(), 0, 1000)); ?> ...</p>
                        </div>
                        <div style="padding-left:50px;">
                            <p><a class="btn btn-primary" href="article-<?= $posts[$i]->id(); ?>" role="button">Voir la suite</a></p>
                        </div>
                    </div>
                </div> 
               <?php endfor; ?> 
        </div>