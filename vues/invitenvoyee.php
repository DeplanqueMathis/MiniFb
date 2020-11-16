<?php

  $sql = "SELECT user.* FROM user INNER JOIN lien ON user.id=idUtilisateur2 AND etat='attente' AND idUtilisateur1=?";
  $q = $pdo->prepare($sql);
  $q->execute(array($_SESSION['id']));
  while($line=$q->fetch()) {
    echo "<div style='border : 1px solid black; width : 10rem'>";
    echo $line['login'] . "<br/>";
    echo "En attente d'une réponse";
    echo "</div>";
  }
  if($line!=$q->fetch()){
    echo "Vous n'avez aucune demande en attente";
  }

?>
