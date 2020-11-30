<?php
$sql = "SELECT user.* FROM user WHERE id IN(SELECT idUtilisateur1 FROM lien WHERE idUtilisateur2=? AND etat='attente') ";

$q = $pdo->prepare($sql);
$q->execute(array($_SESSION['id']));
while($line=$q->fetch()) {
	echo "<nav><div style='border : 1px solid black; width : 10rem'>";
	echo "<a href='index.php?id=" . $line['id'] . "'>" . $line['login'] . "</a><br/>";
	echo "<form action='index.php?action=accept' method='POST'>";
    echo "<input type='number' name='id' value='" . $line['id'] . "' style='display : none;'>";
    echo "<input type='submit' value='Accepter'>";
    echo "</form>";
	echo "En attente d'une réponse";
	echo "</div></nav>";
}
if($line!=$q->fetch()){
  echo "Vous n'avez aucune demande en attente";
}
?>
