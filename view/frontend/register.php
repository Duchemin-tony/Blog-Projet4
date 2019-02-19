<?php
if(isset($_SESSION['idUser']))
{
    header('Location:accueil');
}

$this->setTitle('Inscription - Billet simple pour l\'Alaska'); ?>

<div class="text-center">
  <h1 class="h3 mb-3 font-weight-normal">INSCRIPTION</h1>
    <form method="post" action="index.php?action=register">
      <?php if(isset($_SESSION['errorRegister'])) { echo '<p class="errorBlog">' . $_SESSION['errorRegister'] . '</p>'; } ?>
      <label for="pseudo" class="sr-only">Saisissez un pseudo</label>
      <input type="text" id="pseudo" name="pseudo" class="form-control" placeholder="Saisissez un pseudo" <?php if(isset($msgRegister)) { echo 'value='.$_POST['pseudo']; } ?>>
      <br>
      <label for="pseudoConfirm" class="sr-only">Confirmer votre pseudo</label>
      <input type="text" id="pseudoConfirm" name="pseudoConfirm" class="form-control" placeholder="Confirmer votre pseudo" <?php if(isset($msgRegister)) { echo 'value='.$_POST['pseudoConfirm']; } ?>>
      <br>
      <label for="password" class="sr-only">Mot de passe</label>
      <input type="password" id="password" name="password" class="form-control" placeholder="Mot de passe">
      <br>
      <label for="passwordConfirm" class="sr-only">Confirmez votre mot de passe</label>
      <input type="password" id="passwordConfirm" name="passwordConfirm" class="form-control" placeholder="Confirmez mot de passe" >
      <br>
      <button class="btn btn-lg btn-primary btn-block" type="submit" >S'inscrire</button>
    </form>
</div>
