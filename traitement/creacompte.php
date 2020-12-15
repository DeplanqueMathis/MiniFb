<?php

  if(!empty($_POST['login']) &&
   !empty($_POST['mail']) &&
    !empty($_POST['passwd']) &&
     !empty($_POST['repasswd']) &&
      $_POST['passwd'] == $_POST['repasswd']){
	  $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
  		if (preg_match($regex, $_POST['mail'])){
			$sql = "SELECT * FROM user WHERE login=?";
			$q = $pdo->prepare($sql);
			$q->execute(array($_POST['login']));
			if($line=$q->fetch()){
				header("Location: index.php?action=creation&error=loginalready");
			}
	  		else{
		  	$sql = "SELECT * FROM user WHERE mail=?";
			$q = $pdo->prepare($sql);
			$q->execute(array($_POST['mail']));
			if($line=$q->fetch()){
				header("Location: index.php?action=creation&error=mailalready");
			}
			else{
	  if(isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])){	  
		  $tailleMax = 2097152;
		  $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
		  if($_FILES['avatar']['size'] <= $tailleMax){
			  $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
			  if(in_array($extensionUpload, $extensionsValides)){
				  $today = date("m_d_y"); 
				  $nomfichier = "avatar_" . $today . "_" . rand(0,10000) . "." . $extensionUpload;
				  $chemin = "images/avatars/" . $nomfichier;
				  $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'],$chemin);
				  if($resultat){
					  $sql = "INSERT INTO user (login,mdp,mail,avatar) VALUES( ?, PASSWORD(?) , ?, ?)";
					  $q = $pdo->prepare($sql);
					  $q->execute(array($_POST['login'], $_POST['passwd'], $_POST['mail'], $nomfichier));
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
			}
		}
	  else{
		  header("Location: index.php?action=creation&error=mail");
	  }
  }
  
  else{
    header("Location: index.php?action=creation&error=errone");
  }

?>
