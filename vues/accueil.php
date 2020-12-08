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
          echo "<nav><input type='button' class='bouton_ami' value='Ami' disabled></nav>";
        }

        $sql = "SELECT user.* FROM user INNER JOIN lien ON user.id=idUtilisateur2 AND etat='attente' AND idUtilisateur1=?";
        $q = $pdo->prepare($sql);
        $q->execute(array($_SESSION['id']));
        if($line=$q->fetch()) {
          echo "<nav><input class='demande_attente' type='button' value='En attente' disabled></nav>";
        }

        $sql = "SELECT user.* FROM user WHERE id IN(SELECT idUtilisateur1 FROM lien WHERE idUtilisateur2=? AND etat='attente') ";
        $q = $pdo->prepare($sql);
        $q->execute(array($_SESSION['id']));
        if($line=$q->fetch()) {
          echo "<nav><form action='index.php?action=accept' method='POST'>";
          echo "<input  type='number' name='id' value='" . $_GET['id'] . "' style='display : none;'>";
          echo "<input type='submit'  class='demande_accepter' value='Accepter'>";
          echo "</form></nav>";
        }

        $sql = "SELECT * FROM lien WHERE (idUtilisateur1=? AND idUtilisateur2=?) OR (idUtilisateur1=? AND idUtilisateur2=?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($_SESSION['id'],$_GET['id'],$_GET['id'],$_SESSION['id']));
        if($line=$q->fetch()) {
        }
        else{
            echo "<nav><form  action='index.php?action=demande' method='POST'>";
            echo "<input type='number' name='id' value='" . $_GET['id'] . "' style='display : none;'>";
            echo "<input class='demander_ami' type='submit' value='Demander en ami'>";
            echo "</form></nav>";
        }
       // A completer. Il faut récupérer une ligne, si il y en a pas ca veut dire que lon est pas ami avec cette personne
   }
   if($ok==false) {
       echo "<nav>Vous n êtes pas encore ami, vous ne pouvez voir son mur !!</nav>";
	   if(!isset($_GET['lien'])){
		   header("Location: index.php?id=". $_GET['id'] ."&lien=non");
	   }
   } else {
   // A completer
   // Requête de sélection des éléments dun mur
	$sql = "SELECT * FROM user WHERE id=?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    if($line=$q->fetch()) {
		$login = $line['login'];
	}
    $sql = "SELECT * FROM ecrit WHERE idAmi=? order by dateEcrit DESC";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
	echo "<div class='all-post'>";
    while($line=$q->fetch()) {
		echo "<nav><div class='post_publier' > <b>";
		echo $line['titre'] . "</b><br/>";
		if($_SESSION['id'] == $line['idAuteur'] || $_SESSION['id'] == $line['idAmi']){
			echo"<a href='index.php?action=delete&id=" . $line['id'] . "'>Supprimer</a> ";
		}
		echo $line['contenu'] . "<br/><p>";
		echo $line['dateEcrit'] . "</p>";
		if(!empty($line['image'])){
			echo "<img src='images/img_publi/" . $line['image'] . "'> ";
		}  /*besoin d'une condition pour dire qu'il n'y pas dimage sinon ca fait image cassé*/
		echo "Par : <a href='index.php?id=" . $line['idAuteur'] . "'>$login</a>";
		echo "</div> </nav>";
    }
	echo "</div>";
    // le paramètre  est le $id
   }

?>
