<?php

$sql = "SELECT * FROM user WHERE id IN ( SELECT user.id FROM user INNER JOIN lien ON idUtilisateur1=user.id AND etat='ami' AND idUTilisateur2=? UNION SELECT user.id FROM user INNER JOIN lien ON idUtilisateur2=user.id AND etat='ami' AND idUTilisateur1=?)";
$q = $pdo->prepare($sql);
$q->execute(array($_SESSION['id'],$_SESSION['id']));
while($line=$q->fetch()) {
  echo "<div style='border : 1px solid black; width : 10rem'>";
  echo "<a href='index.php?id=" . $line["id"] . "'>" . $line['login'] . "</a><br/>";
  echo "</div>";
}


?>
