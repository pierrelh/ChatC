<?php

function getTime($time){
  date_default_timezone_set('Europe/Paris');
  $datetime1 = strtotime($time);
  $date = new DateTime($time);
  $now = new DateTime();
  $timeAgo = 'Il y a ';
  if($date->diff($now)->format('%h')<1 && $date->diff($now)->format('%d')<1 && $date->diff($now)->format('%m')<1){
    if ($date->diff($now)->format('%i')>1) {
        $timeAgo .= $date->diff($now)->format("%i minutes.");
    }elseif ($date->diff($now)->format('%i') == 1) {
        $timeAgo .= $date->diff($now)->format("%i minute.");
    }elseif ($date->diff($now)->format('%i') < 1) {
        $timeAgo .= $date->diff($now)->format("moins d'une minute.");
    }
  }elseif ($date->diff($now)->format('%m')>=1) {
      $timeAgo .= $date->diff($now)->format("%m mois.");
  }elseif ($date->diff($now)->format('%d')>=1) {
    if ($date->diff($now)->format('%d')>1) {
        $timeAgo .= $date->diff($now)->format("%d jours.");
    }elseif ($date->diff($now)->format('%d') == 1) {
        $timeAgo .= $date->diff($now)->format("%d jour.");
    }
  }elseif($date->diff($now)->format('%h')>=1){
    if ($date->diff($now)->format('%h')>1) {
        $timeAgo .= $date->diff($now)->format("%h heures.");
    }elseif ($date->diff($now)->format('%h') == 1) {
        $timeAgo .= $date->diff($now)->format("%h heure.");
    }
  }
  return $timeAgo;
}

 ?>
