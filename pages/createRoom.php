<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <link rel="stylesheet" href="../styles/createRoomStyle.css">
    <link rel="stylesheet" href="../styles/master.css">
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      include_once($_SERVER['DOCUMENT_ROOT']."/assets/sidebar.php");
      include_once($_SERVER['DOCUMENT_ROOT']."/functions/getUsers.php");
      if (isset($_POST['create-room-button'])) {
        if ($_POST['room-name'] != '') {
          include_once($_SERVER['DOCUMENT_ROOT']."/functions/getRooms.php");
          createRoom();
        }else {
          echo "Veuillez donner un nom à votre room.";
        }
      }
    ?>

    <div id="chat-zone">
      <h1 class="create-room-title">Créer une Room</h1>
      <form class="create-room-form" method="post">
        <label for="room-name">Nom de la Room</label>
        <br>
        <input class="room-name-input" id="room-name" type="text" name="room-name" value="">
        <br>
        <br>
        <label for="room-users">Invité de la Room</label>
        <br>
        <div class="checkbox-list">
          <ul class="all-checkbox-list">
            <?php getAllUsers('checkbox') ?>
          </ul>
        </div>
        <br>
        <input class="create-room-button-submit" type="submit" name="create-room-button" value="Créer">
      </form>
    </div>
  </body>
</html>
