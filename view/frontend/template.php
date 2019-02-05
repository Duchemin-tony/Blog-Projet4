<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title><?= $this->title(); ?></title>

    <link rel="stylesheet" href="public/css/style.css">
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=zf6tc4vxpu02mnmdmypo90deyyywuucah4xp5u6ta7eogxmh"></script>
      <script type="text/javascript">
    tinymce.init({
        selector: 'textarea',
        height: 200,
        theme: "modern",
        branding: false,
        menubar: false,
        statusbar: false,
        toolbar: false
    });
  </script>

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
  <div class="container">
  <a class="navbar-brand" href="index.php">Billet simple pour l'Alaska</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
<div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
                <?php if(isset($_SESSION['pseudo']))
                {
                    if($_SESSION['statusUser'] == 'administrateur')
                    {
                    ?>
                        <li class="nav-item"><a class="nav-link" href="admin.php">Administration</a></li> 
                    <?php
                    }
                    ?>
                        <li class="nav-item"><a class="nav-link" href="index.php?action=deconnect">Déconnexion</a></li> 
                    <?php
                }
                else
                {
                ?>
                    <li class="nav-item"><a class="nav-link" href="index.php?action=connexion"">Connexion</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?action=register"">Inscription</a></li>
                <?php
                }
                ?>
                
            </ul>
          </div>
        </div>
      </nav>

<main role="main" class="container">

  <div class="starter-template" style="padding-top: 100px;">
    <?= $content ?>
  </div>

<footer>  
  <div class="reserved-bot">
       <p class="text-center">Copyright © 2019 Blog de Jean Forteroche - Tous droits réservés - Réalisé par Duchemin Tony</p>
  </div>
</footer>


</main>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script>

</body>
</html>