<?php
  $link = 'https://' . $_SERVER['HTTP_HOST'];
 ?>

<link rel="stylesheet" href="<?php echo $link ?>/styles/sidebarStyle.css">
<link rel="stylesheet" href="<?php echo $link ?>/styles/master.css">

<div class="sidebar">
  <ul class="sidebar-list">
    <li><a href="<?php echo $link ?>/private.php">Privé</a></li>
    <li><a href="<?php echo $link ?>/general.php">Général</a></li>
    <li><a href="<?php echo $link ?>/users.php">Utilisateurs</a></li>
    <li><a href="<?php echo $link ?>/rooms.php">Rooms</a></li>
  </ul>
</div>
