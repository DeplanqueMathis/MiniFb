<?php
$sql = "SELECT user.* FROM user WHERE id IN(SELECT idUtilisateur1 FROM lien WHERE idUtilisateur2=? AND etat='attente') ";

$q = $pdo->prepare($sql);
$q->execute(array($_SESSION['id']));
$results = $q->fetchall();
  if(empty($results)){
		echo "<nav> <p class='pasinvitrecue'>Aucune ? que c'est triste de ne pas avoir d'amis...</p><img class='pasinvitrecue_img' src='../images/memepleure.jpg' alt='pleure'></nav>";
	}
	else{
		foreach($results as $line){
			echo "<nav><div class='invitrecue'>";
			echo "<a href='index.php?id=" . $line['id'] . "'>De " . $line['login'] . "</a><br/><br/>";
            echo "<p>En attente d'une réponse</p><br/>";
			echo "<form action='index.php?action=accept' method='POST'>";
			echo "<input type='number' name='id' value='" . $line['id'] . "' style='display : none;'>";
			echo "<input type='submit' value='Accepter'>";
			echo "</form>";
			echo "</div></nav>";
		}
	}
?>
