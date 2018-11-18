<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <link rel="stylesheet" href="./styles/master.css">
    <link rel="stylesheet" href="./styles/indexStyle.css">
    <meta charset="utf-8">
    <title></title>
    <?php

    include_once($_SERVER['DOCUMENT_ROOT']."/chatC/functions/getAccount.php");

    if (isset($_POST['connect'])) {
      if (isset($_POST['connect-email']) && $_POST['connect-email'] !== '' && isset($_POST['connect-password']) && $_POST['connect-password'] !== '' ) {
        connectAccount();
      }else {
        echo "Merci de remplir tout les champs.";
      }
    }

    if (isset($_POST['create'])) {
      if (isset($_POST['create-forename']) && $_POST['create-forename'] !== '' && isset($_POST['create-name']) && $_POST['create-name'] !== '' && isset($_POST['create-email']) && $_POST['create-email'] !== '' && isset($_POST['create-mdp1']) && $_POST['create-mdp1'] !== '' && isset($_POST['create-mdp2']) && $_POST['create-mdp2'] !== '') {
        if ($_POST['create-mdp1'] == $_POST['create-mdp2']) {
          createAccount();
        }else {
          echo "Les mots de passe ne correspondent pas.";
        }
      }else {
        echo "Merci de remplir tout les champs.";
      }
    }

    ?>
  </head>
  <body>
    <div class="forms">
      <ul>
        <li>
          <form class="" method="post">
            <p>Se connecter:</p>
            <br>
            <label for="email-connect">Email</label>
            <input id="email-connect" type="email" name="connect-email" value="">
            <br>
            <label for="password-connect">Mot de Passe</label>
            <input id="password-connect" type="password" name="connect-password" value="">
            <br>
            <input class="submit-button" type="submit" name="connect" value="Me Connecter">
          </form>
        </li>
        <li>
          <form class="" method="post">
            <p>Créer un compte:</p>
            <br>
            <label for="forename-create">Prénom</label>
            <input id="forename-create" type="text" name="create-forename" value="">
            <br>
            <label for="name-create">Nom</label>
            <input id="name-create" type="text" name="create-name" value="">
            <br>
            <label for="email-create">Email</label>
            <input id="email-create" type="email" name="create-email" value="">
            <br>
            <label for="password-create">Mot de Passe</label>
            <input id="password-create" type="password" name="create-mdp1" value="">
            <br>
            <label for="repeat-password-create">Répétez le Mot de Passe</label>
            <input id="repeat-password-create" type="password" name="create-mdp2" value="">
            <br>
            <input class="submit-button" type="submit" name="create" value="Créer mon Compte">
          </form>
        </li>
      </ul>
    </div>
  </body>
</html>
