<?php

  if(isset($_POST['login']) &&
   isset($_POST['mail']) &&
    isset($_POST['passwd']) &&
     isset($_POST['repasswd']) &&
      $_POST['passwd'] == $_POST['repasswd']){
	  if(isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])){	  
		  $tailleMax = 2097152;
		  $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
		  if($_FILES['avatar']['size'] <= $tailleMax){
			  $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
			  if(in_array($extensionUpload, $extensionsValides)){
				  $chemin = "images/avatars/" . $_FILES['avatar']['name'];
				  $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'],$chemin);
				  if($resultat){
					  $sql = "INSERT INTO user (login,mdp,mail,avatar) VALUES( ?, PASSWORD(?) , ?, ?)";
					  $q = $pdo->prepare($sql);
					  $q->execute(array($_POST['login'], $_POST['passwd'], $_POST['mail'], $_FILES['avatar']['name']));
					  header("Location: index.php");
				  }
				  else{
					  echo "Problème upload";
					  //header("Location: index.php?action=creation");
				  }
			  }
			  else{
				  echo "Problème taille";
				  //header("Location: index.php?action=creation");
			  }
		  }
		  else{
			  echo "Problème extension";
			  //header("Location: index.php?action=creation");
		  }
	  }
	  	else{
	  		$sql = "INSERT INTO user (login,mdp,mail,avatar) VALUES( ?, PASSWORD(?) , ?, 'avatar.png')";
			$q = $pdo->prepare($sql);
			$q->execute(array($_POST['login'], $_POST['passwd'], $_POST['mail']));
			header("Location: index.php");
  		}
  }
  
  else{
	echo("Problème isset");
    //header("Location: index.php?action=creation");
  }

?>
