<?php

  $sql = "SELECT user.* FROM user INNER JOIN lien ON user.id=idUtilisateur2 AND etat='attente' AND idUtilisateur1=?";
  $q = $pdo->prepare($sql);
  $q->execute(array($_SESSION['id']));
  while($line=$q->fetch()) {
    echo "<nav><div class='invitation_envoye' >";
      echo "<p>Les invitations que vous avez envoyé : </p> </br>";
    echo "A " . $line['login'] . "<br/>";
    echo "En attente d'une réponse";
    echo "</div></nav>";
  }
  if($line!=$q->fetch()){
    echo "Vous n'avez aucune demande en attente";
  }

?>
