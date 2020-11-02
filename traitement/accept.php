<?php

$sql = "UPDATE lien SET etat='ami' WHERE idUtilisateur1=? AND idUtilisateur2=?";
$q = $pdo->prepare($sql);
$q->execute(array($_POST['id'],$_SESSION['id']));
header("Location: index.php?id=" . $_POST['id']);

?>
