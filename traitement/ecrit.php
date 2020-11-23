<?php
if(isset($_POST['titre']) &&
   isset($_POST['message'])){
	  if(isset($_FILES['img_publi']) && !empty($_FILES['img_publi']['name'])){	  
		  $tailleMax = 2097152;
		  $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
		  if($_FILES['img_publi']['size'] <= $tailleMax){
			  $extensionUpload = strtolower(substr(strrchr($_FILES['img_publi']['name'], '.'), 1));
			  if(in_array($extensionUpload, $extensionsValides)){
				  $today = date("m_d_y"); 
				  $nomfichier = "img_" . $today . "_" . rand(0,10000) . "." . $extensionUpload;
				  $chemin = "images/img_publi/" . $nomfichier;
				  $resultat = move_uploaded_file($_FILES['img_publi']['tmp_name'],$chemin);
				  if($resultat){
					  	$sql = "INSERT INTO ecrit VALUES (NULL , ? , ? , NOW() , ? , ? , ?)";
						$q = $pdo->prepare($sql);
						if(isset($_GET["id"])){
							$id = $_GET['id'];
						}
						else{
							$id = $_SESSION['id'];
						}
						$q->execute(array($_POST['titre'],$_POST['message'], $nomfichier ,$_SESSION['id'],$id));

						if(!isset($_GET["id"])){
							header("Location: index.php?id=" . $id);
						}
						else{
							header("Location: index.php");
						}
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
  		}
  }

?>