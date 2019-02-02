<?php $this->setTitle('Connexion administration - Billet simple pour l\'Alaska'); ?> 

<div>
    <p>Vous devez vous connecter pour administrer le Blog :</p>

    <?php if(isset($_SESSION['errorAdmin'])) { echo '<p class="errorAdmin">' . $_SESSION['errorAdmin'] . '</p>'; } ?> 

    <form action="admin.php" method="post">
        <p> 
            <label form="email">Identifiant :</label><br>
            <input type="email" name="email" id="email" required>
        </p>
        <p> 
            <label form="password">Mot de passe :</label><br>
            <input type="password" name="password" id="password" required>
        </p>
        <p> 
            <input type="submit" class="linkPage" value="connexion">
        </p>
    </form>
</div>