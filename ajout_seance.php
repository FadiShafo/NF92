<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Ajouter une séance</title>
  </head>
  <body style="background-image: url('background.png');background-repeat: no-repeat;background-size: cover;">
    <!-- Atout du menu -->
    <?php
      include "menu.php";
    ?>
    <div class="main">

    <h1><center>Ajouter une séance</center></h1>
    <form class="" action="ajouter_seance.php" method="post" >
      <table>
        <tr>
          <td><label for="date">Date :</label></td>
          <td><input id="date" type="date" name="date" value=""><br></td>
        </tr>
        <tr>
          <td><label for="effmax">Effectif maximal :</label></td>
          <td><input type-"text" name="effmax" value=""><br></td>
        </tr>
        <tr>
          <td><label for="theme">Thème :</label></td>
          <td><select name="theme">


      <?php
        include("connexion.php");
        $query ="SELECT * FROM themes WHERE supprime=FALSE";
        $liste_themes = mysqli_query ($connect, $query);
        if (!$liste_themes) {
          echo "La requete $query a échoué : ".mysqli_error($connect);
          echo "<br><a href=\"ajout_seance.php\" >Recommencer en cliquant ici</a>";
          exit();
        }

        foreach($liste_themes as $theme) {
          echo "<option value=\" $theme[idtheme] \">$theme[nom]</options>";
        }

        mysqli_close ($connect);
        ?>

      </select>
      </td>
      </tr>
      <br>
      <tr>
        <td><input type="submit" value="Créer une séance"></td>
      </tr>
      </table>
   </form>
  </div>
  </body>
</html>
