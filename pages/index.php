<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <link rel="stylesheet" href="../styles/hubStyle.css">
    <link rel="stylesheet" href="../styles/chatStyle.css">
    <link rel="stylesheet" href="../styles/master.css">
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      include_once($_SERVER['DOCUMENT_ROOT']."/all/chatC/assets/sidebar.php");
    ?>

    <div id="chat-zone">
      <?php
        include_once($_SERVER['DOCUMENT_ROOT']."/all/chatC/functions/getUsers.php");
        getUserInfos();
      ?>
    </div>
  </body>
</html>
