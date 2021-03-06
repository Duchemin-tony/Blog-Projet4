<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <meta name="keywords" lang="fr" content="jean forteroche, roman, blog, billet simple pour l'Alaska">
    <meta name="reply-to" content="tony76i@live.fr">
    <meta name="category" content="Blog">
    <meta name="Description" content="Blog du célébre écrivain Jean Forteroche qui présente son nouveau roman Billet simple pour l'Alaska">
    <meta name="author" lang="fr" content="Tony Duchemin">
    <meta name="identifier-url" content="http://wwww.jean-forteroche-duchemin.fr">
    <meta name="google-site-verification" content="zfPUmxUP9Bra2yQebRDPujWFpVjtvNsNhouUdk0_CEg" />
    <!-- Meta Open Graph -->
    <meta property="og:title" content="Billet simple pour l'Alaska de Jean Forteroche" />
    <meta property="og:url" content="http://www.jean-forteroche-duchemin.fr/public/images/alaska.jpg" />
    <meta property="og:image" content="http://www.jean-forteroche-duchemin.fr/public/images/alaska.jpg" />
    <meta property="og:description" content="Blog du célébre écrivain Jean Forteroche qui présente son nouveau roman Billet simple pour l'Alaska">
    <meta property="og:locale" content="fr_FR" />
    <title>
      <?= $this->title(); ?>
    </title>
    <link rel="shortcut icon" href="public/images/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="/Blog-Projet4/public/css/style.css">
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=zf6tc4vxpu02mnmdmypo90deyyywuucah4xp5u6ta7eogxmh"></script>
    <script type="text/javascript">
      tinymce.init({
        selector: 'textarea',resize: "both",height: 450,theme: "modern",branding: false,plugins: "preview fullscreen textcolor colorpicker help",toolbar1: "formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat"
      });
    </script>
    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Billet simple pour l'Alaska</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbar">
          <ul class="navbar-nav ml-auto">
            <li><a class="nav-link" href="accueil">Accueil</a></li>
            <?php if(isset($_SESSION['pseudo'])) { ?>
            <li><a class="nav-link" href="index.php?action=deconnect">Déconnexion</a></li>
          </ul>
          <?php } ?>
        </ul>
      </div>
    </div>
  </nav>
  <main class="container">
    <div class="starter-template" style="padding-top: 100px;">
      <?= $content ?>
    </div>
    <div class="reserved-bot">
      <p class="text-center">
        Copyright © 2019 Blog de Jean Forteroche - Tous droits réservés - Réalisé par Duchemin Tony
      </p>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script>
</body>
</html>