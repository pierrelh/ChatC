<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../styles/maintenanceStyle.css">
    <?php
      include_once($_SERVER['DOCUMENT_ROOT']."/chatC/functions/checkMaintenancy.php");
      check(1);
      $maintenancy = getHours();
     ?>
    <title></title>
  </head>
  <body>
    <h1 class="maintenance-title">Aïe, il semblerait que le site soit actuellement en maintenance...</h1>
    <p class="maintenance-txt">Fin de la maintenance: <?php echo $maintenancy[2]; ?></p>
  </body>
</html>
