<?php
    if(!isset($_SESSION["id"])) {
       // On n est pas connecté, il faut retourner à la pgae de login
       header("Location: index.php?action=login");
   }

   // On veut affchier notre mur ou celui d'un de nos amis et pas faire n'importe quoi
   $ok = false;

   if(!isset($_GET["id"]) || $_GET["id"]==$_SESSION["id"]){
       $id = $_SESSION["id"];
       $ok = true; // On a le droit d afficher notre mur
   } else {
       $id = $_GET["id"];
       // Verifions si on est amis avec cette personne
       $sql = "SELECT * FROM lien WHERE etat='ami'
               AND ((idUtilisateur1=? AND idUtilisateur2=?) OR ((idUtilisateur1=? AND idUtilisateur2=?)))";
        $q = $pdo->prepare($sql);
               // Etape 2 : execution : 2 paramètres dans la requêtes !!
        $q->execute(array($_SESSION['id'],$_GET['id'],$_GET['id'],$_SESSION['id']));
               // Etape 3 : ici le login est unique, donc on sait que l'on peut avoir zero ou une  seule ligne.
        if($line=$q->fetch()) {
          $ok = true;
          echo "<input type='button' value='Ami' disabled>";
        }

        $sql = "SELECT user.* FROM user INNER JOIN lien ON user.id=idUtilisateur2 AND etat='attente' AND idUtilisateur1=?";
        $q = $pdo->prepare($sql);
        $q->execute(array($_SESSION['id']));
        if($line=$q->fetch()) {
          echo "<input type='button' value='En attente' disabled>";
        }

        $sql = "SELECT user.* FROM user WHERE id IN(SELECT idUtilisateur1 FROM lien WHERE idUtilisateur2=? AND etat='attente') ";
        $q = $pdo->prepare($sql);
        $q->execute(array($_SESSION['id']));
        if($line=$q->fetch()) {
          echo "<form action='index.php?action=accept' method='POST'>";
          echo "<input type='number' name='id' value='" . $_GET['id'] . "' style='display : none;'>";
          echo "<input type='submit' value='Accepter'>";
          echo "</form>";
        }

        $sql = "SELECT * FROM lien WHERE (idUtilisateur1=? AND idUtilisateur2=?) OR (idUtilisateur1=? AND idUtilisateur2=?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($_SESSION['id'],$_GET['id'],$_GET['id'],$_SESSION['id']));
        if($line=$q->fetch()) {
        }
        else{
            echo "<form action='index.php?action=demande' method='POST'>";
            echo "<input type='number' name='id' value='" . $_GET['id'] . "' style='display : none;'>";
            echo "<input type='submit' value='Demander en ami'>";
            echo "</form>";
        }
       // A completer. Il faut récupérer une ligne, si il y en a pas ca veut dire que lon est pas ami avec cette personne
   }
   if($ok==false) {
       echo "Vous n êtes pas encore ami, vous ne pouvez voir son mur !!";
   } else {
   // A completer
   // Requête de sélection des éléments dun mur
    $sql = "SELECT * FROM ecrit WHERE idAmi=? order by dateEcrit DESC";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    if($line=$q->fetch()) {
		echo "<div style='padding : 5rem; border : 1px solid black; width : 10rem; position:absolute;'>";
		echo $line['titre'] . "<br/>";
		echo $line['contenu'] . "<br/>";
		echo $line['dateEcrit'] . "<br/>";
		if(isset($line['image'])){
			echo "<img src='images/img_publi/" . $line['image'] . "'>";
		}/*
		echo "Par :";
		$sql = "SELECT * FROM user WHERE id=?";
    	$q = $pdo->prepare($sql);
    	$q->execute(array($id));
    	if($line=$q->fetch()) {
			echo "<a href='index.php?id=" . $id . "'>" . $line['login'] . "</a>";
		}*/
		echo "</div>";
    }
    // le paramètre  est le $id
   }

?>
