<?php
  session_start();
  include_once($_SERVER['DOCUMENT_ROOT']."/chatC/functions/getDB.php");

      $message = htmlentities($_POST['message'],ENT_QUOTES);
      $bdd = connect();
      $requser = $bdd->prepare('INSERT INTO private (user_id, message_libelle) VALUES (?, ?)');
      $requser-> execute(array($_SESSION['user_id'], $message));

?>
