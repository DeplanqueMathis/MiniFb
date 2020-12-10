<?php

include("config/config.php");
include("config/bd.php"); // commentaire
include("divers/balises.php");
include("config/actions.php");
session_start();
ob_start(); // Je démarre le buffer de sortie : les données à afficher sont stockées


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link href="css/normalize.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Secteur</title>

    <script src="js/jquery-3.2.1.min.js"></script>
</head>

<body>

<?php
if (isset($_SESSION['info'])) {
    echo "<div>
          <strong>Information : </strong> " . $_SESSION['info'] . "</div>";
    unset($_SESSION['info']);
}
?>


<header>
    <img src="images/LOGO.png" alt="Logo">
</header>
<nav>
    <ul>
        <?php
        if (isset($_SESSION['id'])) {
			echo "<nav><form class='search' action='index.php?action=search' method='post' styme='z-index : 10'>
				<input type='text' name='search' placeholder='  Rechercher un utilisateur'>
				<button type='submit'><i class='material-icons'>search</i></button>
			  </form></nav>";
            
            echo "<ul class='menu_responsive'><li class='accueil'> <a href='index.php'> Accueil</a></li>
            <li class='deconnexion'> <a href='index.php?action=deconnexion'>Déconnexion</a></li></ul>";
            if(!isset($_GET['id'])){
				echo "<div class='profil_responsive'><img class='img_avatar' src='images/avatars/"  . $_SESSION['avatar'] . "'></div>";
            	echo "<div class='fond_avatar'>  <a href='index.php?action=modif'><img class='crayon_avatar' src='images/crayon.png' alt='crayon'></a> <img class='profil_avatar' src='images/profil.png' alt='profil' ><p class='profil_nom'> " . $_SESSION['login'] . "<span> Heureux de vous retrouver !</span></p>
            	<img class='img_avatar' src='images/avatars/"  . $_SESSION['avatar'] . "'>";
			}
			else{
				$sql = "SELECT * FROM user WHERE id=?";
    			$q = $pdo->prepare($sql);
    			$q->execute(array($_GET['id']));
				if($line=$q->fetch()){
					echo "<div class='profil_responsive'><img class='img_avatar' src='images/avatars/"  . $line['avatar'] . "'></div>";
            		echo "<div class='fond_avatar'>
					<img class='profil_avatar' src='images/profil.png' alt='profil' ><p class='profil_nom'> " . $line['login'] . "</p>
            		<img class='img_avatar' src='images/avatars/"  . $line['avatar'] . "'>";
				}
			}
            echo "<li class='accueil'> <a href='index.php'> Accueil</a></li>
            <li class='deconnexion'> <a href='index.php?action=deconnexion'>Déconnexion</a></li> </div>";
			if(!isset($_GET['id'])){
				echo "<li class='bonjour'>Bonjour " . $_SESSION['login'] . " !</li>";
			}
			if(!isset($_GET['action']) || $_GET['action']!="search"){
				echo "<div id='mon_mur' >
                <ul id='menu_amis'><li><p>Mes amis </p> <img class='amis_fleche' src='images/fleche.png' alt='fleche'> <a href='ouvrir' class='menu_ouvrir'><img  class='img_open' src='images/amis.png' alt='ouvrir'> </a>
                
                <ul><li class='vos_amis' ><a href='index.php?action=amis'>Vos amis  </a><br/></li>";
				echo "<li class='invit'><a href='index.php?action=send'>Vos invitations envoyées</a> <br/></li>";
				echo "<li class='invit_recues'><a href='index.php?action=recep'>Vos invitations reçues</a></li></ul></li></ul> ";

                echo "<ul class='vos_amis_responsive' ><li ><a href='index.php?action=amis'>Vos amis  </a><br/></li>";
                echo "<li class='invit'><a href='index.php?action=send'>Vos invitations envoyées</a> <br/></li>";
				echo "<li class='invit_recues'><a href='index.php?action=recep'>Vos invitations reçues</a></li></ul> ";
					if(!isset($_GET['action']) || $_GET['action']!="modif"){
					if(!isset($_GET['action']) || $_GET['action']!="amis"){
					if(!isset($_GET['action']) || $_GET['action']!="send"){
						if(!isset($_GET['action']) || $_GET['action']!="recep"){
							if(!isset($_GET['lien'])){
									echo "<div class='mes_posts'>";
									if(isset($_GET['id'])){
										echo "<form  action='index.php?action=ecrit&id=" . $_GET['id'] . "' method='post' enctype='multipart/form-data'>";
									}
									else{
										echo "<form  action='index.php?action=ecrit' method='post' enctype='multipart/form-data'>";
									}
									echo 
									"<p> Poster quand vous le voulez :  </p>
									<input class='champs_posts' type='text' name='titre' placeholder=' Titre de la publication'><br/>
									<input class='champs_posts' type='text' name='message' placeholder='  Votre message'><br/>
									<input class='img_publi' type='file' id='img_publi' name='img_publi'><br/>
									<input class='valider_posts' type='submit' value='Publier'>
									</form></div>";
							}
						}
					}
				}
			}
            
        }
		}
        ?>
		

    </ul>
</nav>

            <?php
            // Quelle est l'action à faire ?
            if (isset($_GET["action"])) {
                $action = $_GET["action"];
            } else {
                $action = "accueil";
            }

            // Est ce que cette action existe dans la liste des actions
            if (array_key_exists($action, $listeDesActions) == false) {
                include("vues/404.php"); // NON : page 404
            } else {
                include($listeDesActions[$action]); // Oui, on la charge
            }

            ob_end_flush(); // Je ferme le buffer, je vide la mémoire et affiche tout ce qui doit l'être
            ?>


<footer></footer>
</body>
</html>
