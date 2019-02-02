<?php
if(isset($_SESSION['idUser']))
{
    // Redirige le membre vers index.php
    header('Location:index.php');
}

$this->setTitle('Connexion - Billet simple pour l\'Alaska'); ?>


<body class="text-center">
    <form method="post" action="index.php?action=connexion">

      <h1 class="h3 mb-3 font-weight-normal">Connexion</h1>
        
        <?php if(isset($_SESSION['errorConnect'])) { echo '<p class="errorBlog">' . $_SESSION['errorConnect'] . '</p>'; } ?>

  <label for="email" class="sr-only">Pseudo</label>
  <input type="email" id="email" name="email" class="form-control" placeholder="Pseudo" required autofocus><br>

  <label for="password" class="sr-only">Mot de passe</label>
  <input type="password" id="password" name="password" class="form-control" placeholder="Mot de passe" required><br>

  <button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>

  <p class="mt-5 mb-3 text-muted">&copy; 2019</p>
</form>
</body>