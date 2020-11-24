<?php


$sql = "SELECT DISTINCT * FROM user WHERE login LIKE ?"; // La requête
$q = $pdo->prepare($sql);
$q->execute(array("%".$_POST['search']."%"));
while($line=$q->fetch()) {
	echo "<nav>
			<img src='images/avatars/" . $line['avatar'] . "' alt='avatar' style='width : 10%'>
			<a href='index.php?id=" . $line['id'] . "'>" . $line['login'] . "</a><br/>
		  </nav>";
}

?>