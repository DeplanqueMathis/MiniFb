<?php
$sql = "SELECT user.* FROM user WHERE id IN(SELECT idUtilisateur1 FROM lien WHERE idUtilisateur2=? AND etat='attente') ";

$q = $pdo->prepare($sql);
$q->execute(array($_SESSION['id']));
if($line=$q->fetch()) {
  echo "<div style='border : 1px solid black; width : 10rem'>";
  echo $line['login'] . "<br/>";
  echo "En attente d'une réponse";
  echo "</div>";
}
else{
  echo "Vous n'avez aucune demande en attente";
}
?>
