<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ajouter un éléve</title>
    <link rel="stylesheet" href="style.css">

  </head>
  <body style="background-image: url('background.png');background-repeat: no-repeat;background-size: cover;">

  <!-- Atout du menu -->
    <?php
      include "menu.php";
    ?>
    <div class="main">

    <h1><center>Ajout d'un élève</center></h1>
    <form class="" action="valider_eleve.php" method="post">
      <table>
        <tr>
          <td><label for="nom">Nom</label></td>
          <td><input type="text" name="nom" value="" required></td>
        </tr>

        <tr>
          <td><label for="prenom">Prénom</label></td>
          <td><input type="text" name="prenom" value=""></td>
        </tr>

        <tr>
          <td><label for="ddn">Date de naissance</label></td>
          <td><input type="date" name="ddn" value=""></td>
        </tr>

        <tr>
          <td><input type="submit" value="Ajouter"></td>
        </tr>

        <tr>
          <td><input type="reset" value="Reset"></td>
        </tr>
      </table>
    </form>
    </div>
  </body>
</html>
