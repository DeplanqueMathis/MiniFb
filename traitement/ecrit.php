<?php

	$sql = "INSERT INTO ecrit VALUES (NULL , ? , ? , NOW() , '' , ? , ?)";
	$q = $pdo->prepare($sql);
	if(isset($_GET["id"]) || $_GET["id"]==$_SESSION["id"]){
		$id = $_GET['id'];
	}
	else{
		$id = $_SESSION['id'];
	}
	$q->execute(array($_POST['titre'],$_POST['message'],$_SESSION['id'],$id));

	if(!isset($_GET["id"])){
		header("Location: index.php?id=" . $id);
	}
	else{
		header("Location: index.php");
	}

?>