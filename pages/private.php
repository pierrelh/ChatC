<?php
session_start();
if ($_SESSION['user_id'] != 1 && $_SESSION['user_id'] != 2) {
  header("Location:./index.php");
}
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../styles/chatStyle.css">
    <link rel="stylesheet" href="../styles/master.css">
    <meta charset="utf-8">
    <title></title>

  </head>
  <body>

    <?php
      include_once($_SERVER['DOCUMENT_ROOT']."/chatC/assets/sidebar.php");
      include_once($_SERVER['DOCUMENT_ROOT']."/chatC/functions/getChatPrivate.php");
    ?>

    <div id="chat-zone">

    <?php
    getMessage();
      if (isset($_POST['send'])) {
        if ($_POST['user_input'] != '') {
          sendMessage();
        }
      }
    ?>
    </div>

    <?php
      include_once($_SERVER['DOCUMENT_ROOT']."/chatC/assets/interface.php");
    ?>

    <script type="text/javascript">

        var element = document.getElementById('chat-zone');
        element.scrollTop = element.scrollHeight;

    </script>

  </body>
</html>
