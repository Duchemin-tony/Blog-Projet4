<?php 
if(isset($_SESSION['idUser']))
{
    // Redirige le membre vers index.php
    header('Location:accueil');
}
$this->setTitle('Connexion - Billet simple pour l\'Alaska'); ?>

<div class="text-center">
    <form method="post" action="index.php?action=connexion">
      <h1 class="h3 mb-3 font-weight-normal">Connexion</h1>
        <?php if(isset($_SESSION['errorConnect'])) { echo '<p class="errorBlog">' . $_SESSION['errorConnect'] . '</p>'; } ?>
        <label for="pseudo" class="sr-only">Pseudo</label>
        <input type="text" id="pseudo" name="pseudo" class="form-control" placeholder="Pseudo" required autofocus><br>
        <label for="password" class="sr-only">Mot de passe</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Mot de passe" required><br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>
    </form>
</div>