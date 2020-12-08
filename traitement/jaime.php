<?php
$sql = "SELECT * FROM jaime WHERE idUser=? AND idEcrit=?";
$q = $pdo->prepare($sql);
$q->execute(array($_GET['id'],$_GET['post']));
if($line=$q->fetch()){
	$q = $pdo->prepare("DELETE FROM jaime WHERE idUser=? AND idEcrit=?");
	$q->execute(array($_GET['id'],$_GET['post']));
	$q = $pdo->prepare("UPDATE ecrit SET aime=aime-1 WHERE id=?");
	$q->execute(array($_GET['post']));
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else{
	$q = $pdo->prepare("INSERT INTO jaime (idUser,idEcrit) VALUES (?,?)");
	$q->execute(array($_GET['id'],$_GET['post']));
	$q = $pdo->prepare("UPDATE ecrit SET aime=aime+1 WHERE id=?");
	$q->execute(array($_GET['post']));
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

?>