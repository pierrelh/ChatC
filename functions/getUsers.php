<?php
  include_once($_SERVER['DOCUMENT_ROOT']."/all/chatC/functions/getDB.php");

  function getAllUsers($choice){
    $bdd = connect();
    $requser = $bdd->query('SELECT user_name, user_forename, user_id, user_codename FROM users WHERE user_id != "'.$_SESSION['user_id'].'" ORDER BY user_forename ASC');
    $requser-> execute();
    $allUsers = $requser->fetchAll(PDO::FETCH_NUM);
    if ($choice == 'getAll') {
      $i = 0;
      foreach ($allUsers as $user) {
        if ( $i%2 == 0) {
          echo "<a class='user user-one' href='http://localhost/all/chatC/pages/userSingle.php?user_codename=$user[3]'>" . $user[1]. " " . $user[0] . "</a>";
        }else {
          echo "<a class='user user-two' href='http://localhost/all/chatC/pages/userSingle.php?user_codename=$user[3]'>" . $user[1]. " " . $user[0] . "</a>";
        }
        $i++;
      }
    }elseif ($choice == 'checkbox') {
      $userArrayOne = [];
      $userArrayTwo = [];
      $i = 0;
      foreach ($allUsers as $user) {
          if ($i%2 == 0) {
            array_push($userArrayOne, $user);
          }else {
            array_push($userArrayTwo, $user);
          }
        $i++;
      }
      echo "<li class='first-list-element'>
              <ul class='first-list'>";
      $i = 0;
      foreach ($userArrayOne as $user) {
        echo "<li>
                <input id='list-one-". $i ."' class='member checkbox' type='checkbox' name='user-one-". $i ."' value='". $user[2] ."'>
                <label class='member' for='list-one-". $i ."'>" . $user[1] . " " . $user[0] . "</label>
              </li>";
        $i++;
      }
      echo "</ul>
          </li>
          <li class='second-list-element'>
            <ul class='second-list'>";
      $i = 0;
      foreach ($userArrayTwo as $user) {
        echo "<li>
                <input id='list-two-". $i ."' class='member checkbox' type='checkbox' name='user-two-". $i ."' value='". $user[2] ."'>
                <label class='member' for='list-two-". $i ."'>" . $user[1] . " " . $user[0] . "</label>
              </li>";
        $i++;
      }
      echo "</ul>
          </li>";
    }
  }

  function getUserInfos(){
    $bdd = connect();
    $requser = $bdd->query('SELECT user_name, user_forename FROM users WHERE user_id = "'.$_SESSION['user_id'].'"');
    $requser-> execute();
    $userInfos = $requser->fetchAll(PDO::FETCH_NUM);
    $userInfos = $userInfos[0];
    echo "<p class='welcome-txt'>Bienvenue " . $userInfos[1] . " " . $userInfos[0] . "</p>";
  }
?>
