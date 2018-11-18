<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <link rel="stylesheet" href="../styles/roomStyle.css">
    <link rel="stylesheet" href="../styles/master.css">
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      include_once($_SERVER['DOCUMENT_ROOT']."/chatC/assets/sidebar.php");
      include_once($_SERVER['DOCUMENT_ROOT']."/chatC/functions/getRooms.php");
    ?>

    <div id="chat-zone">
      <div class="add-room">
        <ul class="add-room-list">
          <li><a class="add-room-button" href="./createRoom.php">+</a></li>
          <li><a class="add-room-text" href="./createRoom.php">Créer une room.</a></li>
        </ul>
      </div>
      <?php
        getAllRooms();
       ?>
    </div>
  </body>
</html>
