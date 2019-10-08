<?php

  include_once($_SERVER['DOCUMENT_ROOT']."/functions/getDB.php");

  function map_entities($str) {
    return htmlentities($str, ENT_QUOTES);
  }

  function createAccount(){
    $email = $_POST['create-email'];
    $selectSql = "SELECT * FROM users WHERE user_email='".$email."'";
    $db = connect();
    $result =  pg_query($db, $selectSql);
    $val = pg_fetch_all($result);
    foreach ($val as $key => $value) {
      $duplicata = ($value['user_email']);
    }
    if ($duplicata != false) {
      echo "Cette adresse mail est déjà utilisée.";
    }else{
      $filtered = array_map('map_entities', $_POST);
      $name = $_POST['create-name'];
      $forename = $_POST['create-forename'];
      $email = $_POST['create-email'];
      $password = crypt($_POST['create-mdp1'], '48Dudzpx7#Fpa8003s8P@*9s%T_ZA');
      $userCodename = randomString($db);
      $selectSql = "INSERT INTO users (user_name, user_forename, user_email, user_password, user_codename) VALUES ($1, $2, $3, $4, $5)";
      $result =  pg_query_params($db, $selectSql, array($_POST['create-name'], $_POST['create-forename'], $_POST['create-email'], $password, $userCodename));
      $selectSql = "SELECT user_id FROM users WHERE user_email='".$email."' && user_password = '".$password."'";
      $result =  pg_query($db, $selectSql);
      $val = pg_fetch_all($result);
      foreach ($val as $key => $value) {
        $requser = ($value['user_id']);
      }
      setcookie("SESSION_ID", $requser, time()+3600);
      echo "<script>window.location='./pages/';</script>";
    }
  }

  function connectAccount(){
    $email = $_POST['connect-email'];
    $password = crypt($_POST['connect-password'], '48Dudzpx7#Fpa8003s8P@*9s%T_ZA');
    $selectSql = "SELECT user_id FROM users WHERE user_email = $1 AND user_password = $2";
    $db = connect();
    $result =  pg_query_params($db, $selectSql, array($email, $password));
    $val = pg_fetch_all($result);
    foreach ($val as $key => $value) {
      $requser = ($value['user_id']);
    }
    if ($requser != false) {
      setcookie("SESSION_ID", $requser, time()+3600);
      echo "<script>window.location='./pages/';</script>";
    }else{
      echo "Ce compte n'existe pas.";
    }
  }

  function randomString($db) {
  $length = 100;
  $str = "";
  $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
  $max = count($characters) - 1;
  for ($i = 0; $i < $length; $i++) {
    $rand = mt_rand(0, $max);
    $str .= $characters[$rand];
  }
  $selectSql = "SELECT * FROM users WHERE user_codename='".$str."'";
  $result =  pg_query($db, $selectSql);
  foreach ($val as $key => $value) {
    $requser = ($value['user_codename']);
  }
  if ($requser == false) {
    return $str;
  }else {
    randomString($db);
  }
}

?>
