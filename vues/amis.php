<?php

$sql = "SELECT * FROM user WHERE id IN ( SELECT user.id FROM user INNER JOIN lien ON idUtilisateur1=user.id AND etat='ami' AND idUTilisateur2=? UNION SELECT user.id FROM user INNER JOIN lien ON idUtilisateur2=user.id AND etat='ami' AND idUTilisateur1=?)";
$q = $pdo->prepare($sql);
$q->execute(array($_SESSION['id'],$_SESSION['id']));


while($line=$q->fetch()) {
  echo "<nav><div class='mes_amis'>";
    echo "<p>Ma liste d'amis :</p><br/>";
  echo "<a href='index.php?id=" . $line["id"] . "'> " . $line['login'] . "<span>Cliquez pour voir son mur</span></a><br/>";
  echo "</div></nav>";

$results = $q->fetchall();
if(empty($results)){
	echo "<nav>Vous n'avez pas d'amis prenez un Curly !</nav>";


}
else{
	echo "<nav><div class='mes_amis'>";
    echo "<p>Ma liste d'amis :</p><br/>";
	foreach($results as $line) {
  		echo "<a href='index.php?id=" . $line["id"] . "'> " . $line['login'] . "<span>Cliquez pour voir son mur</span></a><br/>";
	}
	echo "</div></nav>";
}?>