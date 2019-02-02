<?php
if(isset($_SESSION['idUser']))
{
    header('Location:index.php');
}

$this->setTitle('Inscription - Billet simple pour l\'Alaska'); ?>


<body class="text-center">
  <h1 class="h3 mb-3 font-weight-normal">INSCRIPTION</h1>
  
    <form method="post" action="index.php?action=register">
  <?php if(isset($_SESSION['errorRegister'])) { echo '<p class="errorBlog">' . $_SESSION['errorRegister'] . '</p>'; } ?>

  <label for="email" class="sr-only">Saisissez un email</label>
  <input type="email" id="email" name="email" class="form-control" placeholder="Saisissez un email" <?php if(isset($msgRegister)) { echo 'value='.$_POST['email']; } ?>>
  <br>

  <label for="emailConfirm" class="sr-only">Confirmer votre email</label>
  <input type="email" id="emailConfirm" name="emailConfirm" class="form-control" placeholder="Confirmer votre email" <?php if(isset($msgRegister)) { echo 'value='.$_POST['emailConfirm']; } ?>>
  <br>

  <label for="password" class="sr-only">Mot de passe</label>
  <input type="password" id="password" name="password" class="form-control" placeholder="Mot de passe">
  <br>

  <label for="passwordConfirm" class="sr-only">Confirmez mot de passe</label>
  <input type="password" id="passwordConfirm" name="passwordConfirm" class="form-control" placeholder="Confirmez mot de passe" >
  <br>

  <button class="btn btn-lg btn-primary btn-block" type="submit" >S'inscrire</button>

  <p class="mt-5 mb-3 text-muted">&copy; 2019</p>

</form>
</body>
