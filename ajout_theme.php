<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ajout d'un thème</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body style="background-image: url('background.png');background-repeat: no-repeat;background-size: cover;">
    <!-- Atout du menu -->
      <?php
        include "menu.php";
      ?>
      <div class="main">

    <h1><center>Ajout d'un thème</center></h1>
    <form class="" action="ajouter_theme.php" method="post">
      <table>
        <tr>
          <td><label for="nom">Nom</label></td>
          <td><input type="text" name="nom" value="" required><br></td>
        </tr>

        <tr>
          <td><label for="desc">Description</label></td>
          <td><textarea name="desc" style="height:7em"></textarea><br></td>
        </tr>

        <tr>
          <td><input type="submit" value="Envoyer"></td>
        </tr>

        <tr>
          <td><input type="reset" value="Reset"></td>
        </tr>
      </table>
    </form>

    </div>
  </body>
</html>
