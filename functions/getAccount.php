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

    // $requser = $bdd->query('SELECT * FROM users WHERE user_email = "'.$email.'"');
    // $requser-> execute();
    // $duplicata = $requser->fetchAll(PDO::FETCH_NUM);
    if ($duplicata != false) {
      echo "Cette adresse mail est déjà utilisée.";
    }else{
      $filtered = array_map('map_entities', $_POST);
      $name = $_POST['create-name'];
      $forename = $_POST['create-forename'];
      $email = $_POST['create-email'];
      $password = crypt($_POST['create-mdp1'], '48Dudzpx7#Fpa8003s8P@*9s%T_ZA');
      $db = connect();
      $userCodename = randomString();
      $selectSql = "INSERT INTO users (user_name, user_forename, user_email, user_password, user_codename) VALUES ($1, $2, $3, $4, $5)";
      $result =  pg_query_params($db, $selectSql, array($_POST['create-name'], $_POST['create-forename'], $_POST['create-email'], $password, $userCodename));
      echo "<script>window.location='./pages/';</script>";

      // $bdd = connect();
      // $userCodename = randomString();
      // $requser = $bdd->prepare('INSERT INTO users (user_name, user_forename, user_email, user_password, user_codename) VALUES (?, ?, ?, ?, ?)');
      // $requser-> execute(array($name, $forename, $email, $password, $userCodename));
      // $requser = $bdd->query('SELECT * FROM users WHERE user_email = "'.$email.'" && user_password = "'.$password.'"');
      // $requser-> execute();
      // $verif = $requser->fetchAll(PDO::FETCH_NUM);
      // $verif = $verif[0];
      // session_start();
      // $_SESSION['user_id'] = $verif[0];
      // $_SESSION['user_name'] = $verif[1];
      // $_SESSION['user_forename'] = $verif[2];
      // $_SESSION['user_email'] = $verif[3];
      // $_SESSION['user_codename'] = $verif[4];
      // header("Location:./pages/");
    }
  }

  function connectAccount(){
    $email = $_POST['connect-email'];
    $password = crypt($_POST['connect-password'], '48Dudzpx7#Fpa8003s8P@*9s%T_ZA');
    $bdd = connect();
    $requser = $bdd->query('SELECT * FROM users WHERE user_email = "'.$email.'" && user_password = "'.$password.'"');
    $requser-> execute();
    $verif = $requser->fetchAll(PDO::FETCH_NUM);
    if ($verif !== []) {
      $verif = $verif[0];
      session_start();
      $_SESSION['user_id'] = $verif[0];
      $_SESSION['user_name'] = $verif[1];
      $_SESSION['user_forename'] = $verif[2];
      $_SESSION['user_email'] = $verif[3];
      $_SESSION['user_codename'] = $verif[4];
      header("Location:./pages/");
    }else{
      echo "Ce compte n'existe pas.";
    }
  }

  function randomString() {
  $length = 100;
  $str = "";
  $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
  $max = count($characters) - 1;
  for ($i = 0; $i < $length; $i++) {
    $rand = mt_rand(0, $max);
    $str .= $characters[$rand];
  }
  $db = connect();
  $selectSql = "SELECT * FROM users WHERE user_codename='".$str."'";
  $result =  pg_query($db, $selectSql);
  foreach ($val as $key => $value) {
    $requser = ($value['user_codename']);
  }
  if ($requser == false) {
    return $str;
  }else {
    randomString();
  }
  // $requser = $bdd->prepare('SELECT * FROM users WHERE user_codename = "'.$str.'"');
  // $requser-> execute();
  // $requser = $requser->fetchAll(PDO::FETCH_NUM);
  // if (empty($requser)) {
  //   return $str;
  // }else {
  //   randomString();
  // }
}

?>
