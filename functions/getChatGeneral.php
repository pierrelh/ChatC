<?php
  include_once($_SERVER['DOCUMENT_ROOT']."/functions/getDB.php");
  include_once($_SERVER['DOCUMENT_ROOT']."/functions/getTime.php");
  $db = connect();

  if (empty($_GET['id'])) {
    $selectSql = "SELECT * FROM general ORDER BY message_date DESC LIMIT 20";
  }else {
    $id = $_GET['id'];
    $selectSql = "SELECT * FROM general WHERE message_id > '".$id."' ORDER BY message_id DESC";
  }
  $result =  pg_query($db, $selectSql);
  $requser = pg_fetch_all($result);

  if (!empty($requser)) {
    $allMessage = array_reverse($requser);
    $usersNames = [];
    foreach ($allMessage as $message) {
      if ($_COOKIE['user_id'] == $message[1]) {
        echo "<p id=\"" . $message[0] . "\" style='margin-right: 15px; margin-left: auto;' class='message my-message'>Vous<br/>" . getTime($message[3]) . "<br/>" . nl2br($message[2]) . "</p>";
      }else {
        if (array_key_exists($message[1], $usersNames)) {
          $userName = $usersNames[$message[1]];
        }else {
          $selectSql = "SELECT user_name, user_forename FROM users WHERE user_id = '".$message[1]."'";
          $result =  pg_query($db, $selectSql);
          $userName = pg_fetch_all($result);
          // $requser = $bdd->query('SELECT user_name, user_forename FROM users WHERE user_id = "'.$message[1].'"');
          // $requser-> execute();
          // $userName = $requser->fetchAll(PDO::FETCH_NUM);
          $userName = $userName[0];
          $usersNames[$message[1]] = $userName;
        }
        echo "<p id=\"" . $message[0] . "\" class='message friend-message'>" . $userName[1] . " " . $userName[0] . "<br/>" . getTime($message[3]) . "<br/>" . nl2br($message[2]) . "</p>";
      }
    }
    $requser->closeCursor();
  }

?>
