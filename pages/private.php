<?php
session_start();
if ($_SESSION['user_id'] != 1 && $_SESSION['user_id'] != 2) {
  header("Location:./index.php");
}else {
  $load = 20;
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
    ?>

    <div id="chat-zone">
      <form class="" method="POST" action="">
        <input class="load-more-messages" type="submit" name="load" value="Charger plus de messages">
      </form>

    <?php
      include_once($_SERVER['DOCUMENT_ROOT']."/chatC/functions/getChatPrivate.php");
    ?>
    </div>

    <?php
      include_once($_SERVER['DOCUMENT_ROOT']."/chatC/assets/interface.php");
    ?>

    <script type="text/javascript">

        var element = document.getElementById('chat-zone');
        element.scrollTop = element.scrollHeight;

        $('#send').click(function(e){
          e.preventDefault();

          var message = $('#message').val();

          if(message != ""){
              $.ajax({
                  url : "../functions/sendChatPrivate.php",
                  type : "POST",
                  data : "message=" + message
              });

             $('#chat-zone').append("<p style='margin-right: 15px; margin-left: auto;' class='message my-message'>" + "Vous <br>" + "Il y a moins d'une minute. <br>" + message + "</p>");
             var element = document.getElementById('chat-zone');
             element.scrollTop = element.scrollHeight;
          }
      });

      function charger(){

        setTimeout( function(){

            var premierID = $('#chat-zone p:last').attr('id'); // on récupère l'id le plus récent

            $.ajax({
                url : "../functions/getChatPrivate.php?id=" + premierID, // on passe l'id le plus récent au fichier de chargement
                type : "GET",
                success : function(html){
                    $('#chat-zone').append(html);
                    var element = document.getElementById('chat-zone');
                    element.scrollTop = element.scrollHeight;
                }
            });

            charger();

        }, 5000);

    }

    charger();



    </script>

  </body>
</html>
