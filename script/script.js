var scroll = function(){
  var element = document.getElementById('chat-zone');
  element.scrollTop = element.scrollHeight;
}

var requestPromo = function(){
  $.ajax({
           url: "../functions/getChatPrivate.php",
           type: "POST",
           data: {myFunction:'getMessage'},
           success: function(data, test){
             var chatZone = document.getElementById('chat-zone');
             chatZone.innerHTML = data;
           }
       });
       scroll();
       // setTimeout(requestPromo(),2000);
}
