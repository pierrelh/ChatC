<?php
  include_once($_SERVER['DOCUMENT_ROOT']."/functions/getDB.php");

  function checkRoom(){
    $roomCodename = $_GET['room_codename'];
    $bdd = connect();
    $requser = $bdd->prepare('SELECT room_users, room_codename FROM rooms WHERE room_codename="'.$roomCodename.'"');
    $requser-> execute();
    $requser = $requser->fetchAll(PDO::FETCH_NUM);
    if (empty($requser)) {
      header("Location:http://localhost/all/chatC/pages/404.php");
    }else {
      $regex = "/\b".$_SESSION['user_id']."\b/i";
      $userRooms = [];
      foreach ($requser as $key => $value) {
        if (preg_match($regex, $value[0])) {
          array_push($userRooms, $value);
        }
      }
      if (empty($userRooms)) {
        header("Location:http://localhost/all/chatC/pages/404.php");
      }
    }
  }

  function sendRoomMessage(){
    $roomCodename = $_GET['room_codename'];
    $message = htmlentities($_POST['user_input'],ENT_QUOTES);
    $date = date("Y-m-d");
    $heure = date("H:i:s");
    $dateTime = $date . ' ' . $heure;
    $bdd = connect();
    $requser = $bdd->prepare('SELECT room_messages FROM rooms WHERE room_codename="'.$roomCodename.'"');
    $requser-> execute();
    $allRoomMessages = $requser->fetchAll(PDO::FETCH_NUM);
    $allRoomMessages = $allRoomMessages[0];
    if ($allRoomMessages[0] == null) {
      $allRoomMessages[0] = $_SESSION['user_id'] . "#$**^^**$#" . $message . "#$**^^**$#" . $dateTime . "(&[|/@£*%!%*£@|]&)";
    }else {
      $allRoomMessages[0] .= $_SESSION['user_id'] . "#$**^^**$#" . $message . "#$**^^**$#" . $dateTime . "(&[|/@£*%!%*£@|]&)";
    }
    $requser = $bdd->prepare('UPDATE rooms SET room_messages = "'.$allRoomMessages[0].'" WHERE room_codename = "'.$roomCodename.'"');
    $requser-> execute();
    header("Refresh:0");
  }

  function getRoomMessage(){
    include_once($_SERVER['DOCUMENT_ROOT']."/all/chatC/functions/getTime.php");
    $usersNames = [];
    $roomCodename = $_GET['room_codename'];
    $bdd = connect();
    $requser = $bdd->prepare('SELECT room_messages FROM rooms WHERE room_codename="'.$roomCodename.'"');
    $requser-> execute();
    $allRoomMessages = $requser->fetchAll(PDO::FETCH_NUM);
    $allRoomMessages = $allRoomMessages[0];
    if ($allRoomMessages[0] == null) {
      echo "Commencez à discuter.";
    }else {
      $allMessages = explode("(&[|/@£*%!%*£@|]&)", $allRoomMessages[0]);
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

 ?>
