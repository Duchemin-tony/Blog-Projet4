<?php $this->setTitle('Connexion administration - Billet simple pour l\'Alaska'); ?> 

<div class="text-center">
    <form method="post" action="admin.php">

      <h1 class="h3 mb-3 font-weight-normal">Connexion</h1>
      <p>Vous devez vous connecter pour administrer le Blog :</p>
        
        <?php if(isset($_SESSION['errorConnect'])) { echo '<p class="errorBlog">' . $_SESSION['errorConnect'] . '</p>'; } ?>

  <label for="email" class="sr-only">Pseudo</label>
  <input type="email" id="email" name="email" class="form-control" placeholder="Email" required autofocus><br>

  <label for="password" class="sr-only">Mot de passe</label>
  <input type="password" id="password" name="password" class="form-control" placeholder="Mot de passe" required><br>

  <button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>

</form>
</div>