<?php
  include_once($_SERVER['DOCUMENT_ROOT']."/all/chatC/functions/getDB.php");

  function check($location){
    $bdd = connect();
    $requser = $bdd->query('SELECT * FROM maintenance WHERE id = "1" ');
    $requser-> execute();
    $maintenancy = $requser->fetchAll(PDO::FETCH_NUM);
    $maintenancy = $maintenancy[0];
    if ($maintenancy[1] == 1) {
      if ($location == 0) {
        header("Location:http://localhost/all/chatC/pages/maintenance.php");
      }
    }elseif ($location == 1) {
      header("Location:http://localhost/all/chatC/pages/index.php");
    }
  }

  function getHours(){
    $bdd = connect();
    $requser = $bdd->query('SELECT * FROM maintenance WHERE id = "1" ');
    $requser-> execute();
    $maintenancy = $requser->fetchAll(PDO::FETCH_NUM);
    $maintenancy = $maintenancy[0];
    return $maintenancy;
  }

 ?>
