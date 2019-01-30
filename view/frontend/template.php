<?php ob_start(); ?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Un billet simple pour l'Alaska</title>

    <!-- Bootstrap core CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#">Billet simple pour l'Alaska</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

 <div class="collapse navbar-collapse" id="navbarCollapse">


                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">                         
                            <a class="nav-link" href="index.php">Accueil<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=listPosts">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=contact">Contact</a>
                        </li>
                    </ul>

                    <?php if (!isset($_SESSION['login'])) { ?>

                  <form class="navbar-form navbar-right" method="POST" style="display: flex;">
                    <?php if (isset($_SESSION['message'])) { ?>
                      <div class="form-group"><p class="red"><?= $_SESSION['message'] ?></p></div>
                    <?php } ?>
                    <div class="form-group">
                      <input name="login" type="text" id="login" placeholder="Identifiant" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" name="pass" id="pass" placeholder="Mot de passe" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success">Connexion</button>
                  </form>

              <?php
          }
          else {
          ?>
            
            <ul class="nav navbar-right navbar-nav">
              <li><a href="index.php?action=admin"><button class="btn btn-xs btn-info">Accéder à la partie Admin</button></a></li>
              <li><a href="index.php?admin=logout"><button class="btn btn-xs btn-primary">Déconnexion</button></a></li>
              </ul>

            <?php
          }
          ?>
                </div>
            </nav>

<main role="main" class="container">

  <div class="starter-template" style="padding-top: 100px;">
  	<?= $content ?>
  </div>

</main><!-- /.container -->
</body>
</html>