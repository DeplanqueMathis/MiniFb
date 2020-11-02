<?php

  if(isset($_POST['login']) &&
   isset($_POST['mail']) &&
    isset($_POST['passwd']) &&
     isset($_POST['repasswd']) &&
      $_POST['passwd'] == $_POST['repasswd']){
    $sql = "INSERT INTO user VALUES('', ?, PASSWORD(?) , ?, '', '')";
    $q = $pdo->prepare($sql);
    $q->execute(array($_POST['login'], $_POST['passwd'], $_POST['mail']));
  }
  else{
    header("Location: index.php?action=creation");
  }

?>
