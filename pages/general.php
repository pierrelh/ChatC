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
      include_once($_SERVER['DOCUMENT_ROOT']."/assets/sidebar.php");
    ?>

    <div id="chat-zone">
      <form class="" method="POST" action="">
        <input class="load-more-messages" type="submit" name="load" value="Charger plus de messages">
      </form>

      <?php
        include_once($_SERVER['DOCUMENT_ROOT']."/functions/getChatGeneral.php");
      ?>
    </div>

    <?php
      include_once($_SERVER['DOCUMENT_ROOT']."/assets/interface.php");
    ?>

    <script type="text/javascript">

      $('#send').click(function(e){
        e.preventDefault();

        var message = $('#message').val();

        if(message != ""){
            $.ajax({
                url : "../functions/sendChatGeneral.php",
                type : "POST",
                data : "message=" + message
            });

            var premierID = parseInt( $('#chat-zone p:last').attr('id')) + 1;

            $('#chat-zone').append("<p id='" + premierID + "' style='margin-right: 15px; margin-left: auto;' class='message my-message'>" + "Vous <br>" + "Il y a moins d'une minute. <br>" + message + "</p>");
            var element = document.getElementById('chat-zone');
            element.scrollTop = element.scrollHeight;
        }
      });

      function charger(){
        setTimeout( function(){

            var premierID = $('#chat-zone p:last').attr('id');

            $.ajax({
                url : "../functions/getChatGeneral.php?id=" + premierID,
                type : "GET",
                success : function(html){
                    $('#chat-zone').append(html);
                    var element = document.getElementById('chat-zone');
                    if (element.scrollHeight - element.scrollTop < 800) {
                      element.scrollTop = element.scrollHeight;
                    }
                }
            });
            charger();
        }, 5000);
    }

    charger();

      var element = document.getElementById('chat-zone');
      element.scrollTop = element.scrollHeight;
    </script>

  </body>
</html>
