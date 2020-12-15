<?php
?>
 <nav>
<li class='creation_compte_seco'>
    <p>Déjà un compte ?</p>
    <a href='index.php?action=login'>Connectez-vous !</a>
</li>
</nav>
<nav>
<?php
	if(isset($_GET['error'])){
		if($_GET['error'] == 'mail'){
			echo "<div><h1>L'adresse mail entrée est erronée</h1></div>";
		}
		if($_GET['error'] == 'mailalready'){
			echo "<div><h1>Cette adresse mail est déjà utilisée</h1></div>";
		}
		if($_GET['error'] == 'loginalready'){
			echo "<div><h1>Ce login est déjà utilisée</h1></div>";
		}
	}
?>
</nav>
    <div class="creation_compte">
<form action='index.php?action=creacompte' method='POST' enctype="multipart/form-data">
    <p>Choisssez votre avatar</p>
<input class="avatar_creation_compte" type="file" id="avatar" name="avatar"
       style="border: none;
    opacity: 0.5;"><br/>
<input class="champs_creation_compte" type="text" name="login" placeholder="  Identifiant"><br/>
<input class="champs_creation_compte" type="email" name="mail" placeholder="  Mail"><br/>
<input class="champs_creation_compte" type="password" name="passwd" placeholder="  Mot de passe"><br/>
<input class="champs_creation_compte" type="password" name="repasswd" placeholder="  Répétez le mot de passe"><br/>
<input class="valider_creation_compte" type='submit' value='Valider' /><br/>
</form>
    </div>
