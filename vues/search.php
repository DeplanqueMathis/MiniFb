<?php


$sql = "SELECT DISTINCT * FROM user WHERE login LIKE ?"; // La requête
$q = $pdo->prepare($sql);
$q->execute(array("%".$_POST['search']."%"));
while($line=$q->fetch()) {
	echo "<nav>
    <p class='search_p'>Utilisateur trouvé : </p>
			<img class='search_avatar' src='images/avatars/" . $line['avatar'] . "' alt='avatar' style='width : 5%'> 
			<a class='search_nom' href='index.php?id=" . $line['id'] . "'>" . $line['login'] . "</a><br/> 
		  </nav>";
}

?>