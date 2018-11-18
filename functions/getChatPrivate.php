<?php
  include_once($_SERVER['DOCUMENT_ROOT']."/chatC/functions/getDB.php");

  function sendMessage(){
    $message = htmlentities($_POST['user_input'],ENT_QUOTES);
    $bdd = connect();
    $requser = $bdd->prepare('INSERT INTO private (user_id, message_libelle) VALUES (?, ?)');
    $requser-> execute(array($_SESSION['user_id'], $message));
    $date = date("Y-m-d");
    $heure = date("H:i:s");
    $dateTime = $date . ' ' . $heure;
    $requser = $bdd->prepare('UPDATE lastmessage SET message_time = "'.$dateTime.'" WHERE chat_codename = "private"');
    $requser-> execute();
    $requser = $bdd->query('SELECT message_time FROM lastmessage WHERE chat_codename = "private"');
    $requser-> execute();
    $lastMessage = $requser->fetchAll(PDO::FETCH_NUM);
    $lastMessage = $lastMessage[0];
    $GLOBALS['lastMessage'] = $lastMessage[0];
  }

  function getMessage(){
    include_once($_SERVER['DOCUMENT_ROOT']."/chatC/functions/getTime.php");
    $GLOBALS['privateMessages'] = '';
    $bdd = connect();
    $requser = $bdd->query('SELECT * FROM private ORDER BY message_date ASC');
    $requser-> execute();
    $allMessage = $requser->fetchAll(PDO::FETCH_NUM);
    $usersNames = [];
    foreach ($allMessage as $message) {
      if ($_SESSION['user_id'] == $message[1]) {
        echo "<p style='margin-right: 15px; margin-left: auto;' class='message my-message'>Vous<br/>" . getTime($message[3]) . "<br/>" . nl2br($message[2]) . "</p>";
      }else {
        if (array_key_exists($message[1], $usersNames)) {
          $userName = $usersNames[$message[1]];
        }else {
          $bdd = connect();
          $requser = $bdd->query('SELECT user_name, user_forename FROM users WHERE user_id = "'.$message[1].'"');
          $requser-> execute();
          $userName = $requser->fetchAll(PDO::FETCH_NUM);
          $userName = $userName[0];
          $usersNames[$message[1]] = $userName;
        }
        echo "<p class='message friend-message'>" . $userName[1] . " " . $userName[0] . "<br/>" . getTime($message[3]) . "<br/>" . nl2br($message[2]) . "</p>";
      }
    }
    return $GLOBALS['privateMessages'];
  }

?>
