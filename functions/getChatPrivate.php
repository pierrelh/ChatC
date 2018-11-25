<?php
  include_once($_SERVER['DOCUMENT_ROOT']."/chatC/functions/getDB.php");
  include_once($_SERVER['DOCUMENT_ROOT']."/chatC/functions/getTime.php");
  $bdd = connect();

  if (empty($_GET['id'])) {
    $requser = $bdd->prepare('SELECT * FROM private ORDER BY message_date DESC LIMIT 20');
    $requser-> execute();
  }else {
    session_start();
    $id = (int) $_GET['id'];
    $requser = $bdd->prepare('SELECT * FROM private WHERE message_id > :id ORDER BY message_id DESC');
    $requser->execute(array("id" => $id));
  }

  if (!empty($requser)) {
    $allMessage = array_reverse($requser->fetchAll(PDO::FETCH_NUM));
    $usersNames = [];
    foreach ($allMessage as $message) {
      if ($_SESSION['user_id'] == $message[1]) {
        echo "<p id=\"" . $message[0] . "\" style='margin-right: 15px; margin-left: auto;' class='message my-message'>Vous<br/>" . getTime($message[3]) . "<br/>" . nl2br($message[2]) . "</p>";
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
        echo "<p id=\"" . $message[0] . "\" class='message friend-message'>" . $userName[1] . " " . $userName[0] . "<br/>" . getTime($message[3]) . "<br/>" . nl2br($message[2]) . "</p>";
      }
    }
    $requser->closeCursor();
  }

?>
