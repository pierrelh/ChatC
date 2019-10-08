<?php
  session_start();
  include_once($_SERVER['DOCUMENT_ROOT']."/functions/getDB.php");

      $message = htmlentities($_POST['message'],ENT_QUOTES);
      $bd = connect();
      $selectSql = "INSERT INTO general (user_id, message_libelle, message_date) VALUES ($1, $2, $3)";
      $result =  pg_query_params($db, $selectSql, array($_COOKIE['user_id'], $message, NOW()));
      // $requser = $bdd->prepare('INSERT INTO general (user_id, message_libelle, message_date) VALUES (?, ?, ?)');
      // $requser-> execute(array($_SESSION['user_id'], $message));

?>
