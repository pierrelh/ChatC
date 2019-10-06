<?php
include_once($_SERVER['DOCUMENT_ROOT']."/all/chatC/functions/getDB.php");

function checkUser(){
  $userCodename = $_GET['user_codename'];
  $bdd = connect();
  $requser = $bdd->prepare('SELECT user_codename, user_id FROM users WHERE user_codename="'.$userCodename.'"');
  $requser-> execute();
  $requser = $requser->fetchAll(PDO::FETCH_NUM);
  if (empty($requser)) {
    header("Location:http://localhost/all/chatC/pages/404.php");
  }else {
    $requser = $requser[0];
    $chatCodeNameOne = $_SESSION['user_codename'] . $requser[0];
    $chatCodeNameTwo =  $requser[0] . $_SESSION['user_codename'];
    $requserTwo = $bdd->prepare('SELECT * FROM userschats WHERE chat_codename="'.$chatCodeNameTwo.'" OR chat_codename="'.$chatCodeNameOne.'"');
    $requserTwo-> execute();
    $requserTwo = $requserTwo->fetchAll(PDO::FETCH_NUM);
    if (empty($requserTwo)) {
      $chatUsers = $_SESSION['user_id'] . "@#//#@" . $requser[1];
      $requser = $bdd->prepare('INSERT INTO userschats (chat_users, chat_codename) VALUES (?, ?)');
      $requser-> execute(array($chatUsers, $chatCodeNameOne));
    }
  }
}

function getChatMessage(){
  include_once($_SERVER['DOCUMENT_ROOT']."/all/chatC/functions/getTime.php");
  $chatCodeNameOne = $_SESSION['user_codename'] . $_GET['user_codename'];
  $chatCodeNameTwo =  $_GET['user_codename'] . $_SESSION['user_codename'];
  $bdd = connect();
  $requserTwo = $bdd->prepare('SELECT * FROM userschats WHERE chat_codename="'.$chatCodeNameTwo.'" OR chat_codename="'.$chatCodeNameOne.'"');
  $requserTwo-> execute();
  $requserTwo = $requserTwo->fetchAll(PDO::FETCH_NUM);
  $requserTwo = $requserTwo[0];
  if ($requserTwo[2] == null) {
    echo "<p>Commencez à discuter.</p>";
  }else {
    $allMessages = explode("(&[|/@£*%!%*£@|]&)", $requserTwo[2]);
    $max = count($allMessages) -1;
    unset($allMessages[$max]);
    foreach ($allMessages as $message) {
      $message = explode("#$**^^**$#", $message);
      if ($_SESSION['user_id'] == $message[0]) {
        echo "<p style='margin-right: 15px; margin-left: auto;' class='message my-message'>Vous<br/>" . getTime($message[2]) . "<br/>" . nl2br($message[1]) . "</p>";
      }else {
        if (array_key_exists($message[0], $usersNames)) {
          $userName = $usersNames[$message[0]];
        }else {
          $bdd = connect();
          $requser = $bdd->query('SELECT user_name, user_forename FROM users WHERE user_id = "'.$message[0].'"');
          $requser-> execute();
          $userName = $requser->fetchAll(PDO::FETCH_NUM);
          $userName = $userName[0];
          $usersNames[$message[0]] = $userName;
        }
        echo "<p class='message friend-message'>" . $userName[1] . " " . $userName[0] . "<br/>" . getTime($message[2]) . "<br/>" . nl2br($message[1]) . "</p>";
      }
    }
  }
}

function sendChatMessage(){
  $chatCodeNameOne = $_SESSION['user_codename'] . $_GET['user_codename'];
  $chatCodeNameTwo =  $_GET['user_codename'] . $_SESSION['user_codename'];
  $message = htmlentities($_POST['user_input'],ENT_QUOTES);
  $date = date("Y-m-d");
  $heure = date("H:i:s");
  $dateTime = $date . ' ' . $heure;
  $bdd = connect();
  $requserTwo = $bdd->prepare('SELECT chat_messages FROM userschats WHERE chat_codename="'.$chatCodeNameTwo.'" OR chat_codename="'.$chatCodeNameOne.'"');
  $requserTwo-> execute();
  $allChatMessages = $requserTwo->fetchAll(PDO::FETCH_NUM);
  $allChatMessages = $allChatMessages[0];
  if ($allChatMessages[0] == null) {
    $allChatMessages[0] = $_SESSION['user_id'] . "#$**^^**$#" . $message . "#$**^^**$#" . $dateTime . "(&[|/@£*%!%*£@|]&)";
  }else {
    $allChatMessages[0] .= $_SESSION['user_id'] . "#$**^^**$#" . $message . "#$**^^**$#" . $dateTime . "(&[|/@£*%!%*£@|]&)";
  }
  $requser = $bdd->prepare('UPDATE userschats SET chat_messages = "'.$allChatMessages[0].'" WHERE chat_codename = "'.$chatCodeNameTwo.'" OR chat_codename="'.$chatCodeNameOne.'"');
  $requser-> execute();
  header("Refresh:0");
}
 ?>
