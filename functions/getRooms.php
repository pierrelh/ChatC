<?php
  include_once($_SERVER['DOCUMENT_ROOT']."/functions/getDB.php");

  function createRoom(){
    $roomName = $_POST['room-name'];
    unset($_POST['create-room-button'], $_POST['room-name']);
    $users = $_SESSION['user_id'];
    foreach ($_POST as $key => $value) {
      $users .= "@#//#@" . $value;
    }
    $roomCodename = randomString();
    $bdd = connect();
    $requser = $bdd->prepare('INSERT INTO rooms (room_name, room_users, room_codename) VALUES (?, ?, ?)');
    $requser-> execute(array($roomName, $users, $roomCodename));
  }

  function getAllRooms(){
    $bdd = connect();
    $regex = "/\b".$_SESSION['user_id']."\b/i";
    $requser = $bdd->prepare('SELECT room_id, room_name, room_users, room_codename FROM rooms');
    $requser-> execute();
    $allRooms = $requser->fetchAll(PDO::FETCH_NUM);
    $userRooms = [];
    foreach ($allRooms as $key => $value) {
      if (preg_match($regex, $value[2])) {
        array_push($userRooms, $value);
      }
    }
    $i = 0;
    foreach ($userRooms as $key => $value) {
      if ($i%2 == 0) {
        echo "<a class='room room-one' href='http://localhost/all/chatC/pages/roomSingle.php?room_codename=$value[3]'>". $value[1] ."</a>";
      }else {
        echo "<a class='room room-two' href='http://localhost/all/chatC/pages/roomSingle.php?room_codename=$value[3]'>". $value[1] ."</a>";
      }
      $i++;
    }
  }

  function randomString() {
  $length = 100;
	$str = "";
	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
  $bdd = connect();
  $requser = $bdd->prepare('SELECT * FROM rooms WHERE room_codename = "'.$str.'"');
  $requser-> execute();
  $requser = $requser->fetchAll(PDO::FETCH_NUM);
  if (empty($requser)) {
    return $str;
  }else {
    randomString();
  }
}

?>
