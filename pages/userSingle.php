<?php
  session_start();
  include_once($_SERVER['DOCUMENT_ROOT']."/all/chatC/functions/getChatUsers.php");
  checkUser();
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
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
      getChatMessage();
      if (isset($_POST['send'])) {
        if ($_POST['user_input'] != '') {
          sendChatMessage();
        }
      }
    ?>
    </div>

    <?php
      include_once($_SERVER['DOCUMENT_ROOT']."/all/chatC/assets/interface.php");
    ?>

    <script type="text/javascript">
      var element = document.getElementById('chat-zone');
      element.scrollTop = element.scrollHeight;
    </script>

  </body>
</html>
