<?php
		$sql = "SELECT * FROM user WHERE id=?"; // La requête
		$q = $pdo->prepare($sql);
		$q->execute(array($_SESSION['id']));
		if($line=$q->fetch()) {
			echo "<nav>
				<form method='post' action='index.php?action=enrmodif' enctype='multipart/form-data'>
				<fieldset>
				<legend>Modifier</legend>
				<form action='index.php?action=creacompte' method='POST' enctype='multipart/form-data'>
				<p>Choisssez votre avatar</p>
				<input class='avatar_creation_compte' type='file' id='avatar' name='avatar'
					   style='border: none;
					opacity: 0.5;'><br/>
				<input class='champs_creation_compte' value='". $line['login'] ."' type='text' name='login' placeholder='Identifiant'><br/>
				<input class='champs_creation_compte' value='". $line['mail'] ."' type='email' name='mail' placeholder='Mail'><br/>
				<input class='champs_creation_compte' type='password' name='passwd' placeholder='Mot de passe'><br/>
				<input class='champs_creation_compte' type='password' name='repasswd' placeholder='Répétez le mot de passe'><br/>
				<input class='valider_creation_compte' type='submit' value='Valider' /><br/>
				</form>

			</fieldset>
			<form>
			</nav>
		";
		}
?>