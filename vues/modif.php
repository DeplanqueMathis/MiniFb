<?php
		if(isset($_GET['error'])){
			if($_GET['error'] == 'mail'){
				echo "<nav><div id='error'><h1>L'adresse mail entrée est erronée</h1><a href='index.php?action=modif' id='lienerror'><img src='images/croix.png' alt='Fermer'></a></div></nav>";
			}
			if($_GET['error'] == 'mailalready'){
				echo "<nav><div id='error'><h1>Cette adresse mail est déjà utilisée</h1><a href='index.php?action=modif' id='lienerror'><img src='images/croix.png' alt='Fermer'></div></nav>";
			}
			if($_GET['error'] == 'loginalready'){
				echo "<nav><div id='error'><h1>Ce login est déjà utilisée</h1><a href='index.php?action=modif' id='lienerror'><img src='images/croix.png' alt='Fermer'></div></nav>";
			}
		}
		$sql = "SELECT * FROM user WHERE id=?"; // La requête
		$q = $pdo->prepare($sql);
		$q->execute(array($_SESSION['id']));
		if($line=$q->fetch()) {
			echo "<nav>
				<form class='modif_profil' method='post' action='index.php?action=enrmodif' enctype='multipart/form-data'>
				<fieldset>
				<legend>Modifier</legend>
				<p>Choisssez votre avatar</p></br>
				<input class='avatar_creation_compte' type='file' id='avatar' name='avatar'
					   style='border: none;
					opacity: 0.5;'><br/>
				<input class='champs_creation_compte' value='". $line['login'] ."' type='text' name='login' placeholder='Identifiant'><br/>
				<input class='champs_creation_compte' value='". $line['mail'] ."' type='email' name='mail' placeholder='Mail'><br/>
				<input class='champs_creation_compte' type='password' name='passwd' placeholder='Mot de passe'><br/>
				<input class='champs_creation_compte' type='password' name='repasswd' placeholder='Répétez le mot de passe'><br/>
				<input class='valider_creation_compte' type='submit' value='Valider' /><br/>

			</fieldset>
			<form>
			</nav>
		";
		}
?>