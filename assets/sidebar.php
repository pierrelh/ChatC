<?php
  $link = 'https://' . $_SERVER['HTTP_HOST'];
 ?>

<link rel="stylesheet" href="<?php echo $link ?>/styles/sidebarStyle.css">
<link rel="stylesheet" href="<?php echo $link ?>/styles/master.css">

<div class="sidebar">
  <ul class="sidebar-list">
    <li><a href="<?php echo $link ?>/pages/private.php">Privé</a></li>
    <li><a href="<?php echo $link ?>/pages/general.php">Général</a></li>
    <li><a href="<?php echo $link ?>/pages/users.php">Utilisateurs</a></li>
    <li><a href="<?php echo $link ?>/pages/rooms.php">Rooms</a></li>
  </ul>
</div>
