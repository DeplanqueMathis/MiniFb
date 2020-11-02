<?php

$sql = "INSERT INTO lien VALUES(NULL,?,?,'attente') ";
$q = $pdo->prepare($sql);
$q->execute(array($_SESSION['id'],$_POST['id']));
header("Location: index.php?id=" . $_POST['id']);

?>
