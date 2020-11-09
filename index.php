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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma super application</title>




    <!-- Ma feuille de style à moi -->
    <link href="./css/style.css" rel="stylesheet">

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
            echo "<img class='fond_avatar' src='images/sky-03.jpg' alt='fond'> <img class='img_avatar' src='images/avatar.png"  . $_SESSION['avatar'] . "'> 
			<li>Bonjour " . $_SESSION['login'] . "</li>
            <li class='deconnexion'> <a href='index.php?action=deconnexion'>Deconnexion</a></li>";
            echo "<li class='invit'><a href='index.php?action=send'>Vos invitations envoyées</a></li>";
            echo "<li><a href='index.php?action=recep'>Vos invitations reçues</a></li>";
            echo "<li><a href='index.php?action=amis'>Vos amis</a></li>";
			echo "<form action='index.php?action=ecrit' method='post'>";
			echo "<input type='text' name='titre' placeholder='Titre de la publication'>";
			echo "<input type='text' name='message' placeholder='Votre message'>";
			echo "<input type='submit' value='Publier'>";
			echo "</form>";
        } else {
            echo /*"<li><a href='index.php?action=login'>Login</a></li>*/"
            <li class='creercompte'><p>Pas encore de compte ?</p><a href='index.php?action=creation'>Rejoins-nous !</a></li>";
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


<footer>Le pied de page</footer>
</body>
</html>
