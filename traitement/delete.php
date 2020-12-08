<?php
$sql = "SELECT * FROM ecrit WHERE id=?";
$q = $pdo->prepare($sql);
$q->execute(array($_GET['id']));
if($line=$q->fetch()){
	unlink('images/img_publi/'.$line['image']);
}
$sql = "DELETE FROM ecrit WHERE id=?";
$q = $pdo->prepare($sql);
$q->execute(array($_GET['id']));
header("Location: index.php");

?>