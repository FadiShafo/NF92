<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Desinscription d'un éléve</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body style="background-image: url('background.png');background-repeat: no-repeat;background-size: cover;">
      <!-- Atout du menu -->
      <?php
        include "menu.php";
      ?>
      <div class="main">
      <h1><center>Desinscription d'un élève d'une séance </center></h1>

      <form action="desinscrire_seance.php" method="post">

        <table>

          <tr>
            <td> <p>Choisir l'éléve:</p> </td>
            <td> <p>Choisir la séance:</p> </td>
          </tr>
          <tr>
          <?php
            // connexion
            include 'connexion.php';

            //requete pour les eleves
            $query_eleves = "SELECT * FROM eleves"; // recuperer la liste de tous les eleves
            $result_eleves = mysqli_query($connect, $query_eleves);

            if (!$result_eleves) {
              echo "La requete $query_eleves a échoué : ".mysqli_error($connect);
              echo "<br><a href=\"desinscription_seance.php\" >Recommencer en cliquant ici</a>";
              exit();
            }

            // determiner la date du jour
            date_default_timezone_set('Europe/Paris');
            $date = date("Y-m-d");

            //requete pour les seances
            $query_seances = "SELECT * FROM seances INNER JOIN themes ON themes.idtheme = seances.idtheme where seances.DateSeance>=$date"; //recuperer les séances à venir
            $result_seances = mysqli_query($connect, $query_seances);

            if (!$result_seances) {
              echo "La requete $query_seances a échoué : ".mysqli_error($connect);
              echo "<br><a href=\"desinscription_seance.php\" >Recommencer en cliquant ici</a>";
              exit();
            }


          	// select eleve
          	echo "<td> <select name='ideleve' required>";

            while ($row = mysqli_fetch_array($result_eleves))
            {
            echo "<option value=$row[ideleve]> $row[nom] $row[prenom]</option>"; // eleves
            }
            echo "</select></td>";

          	// select seances
            echo "<td><select name='idseance' required>";
            while ($row2 = mysqli_fetch_array($result_seances))
            {
            echo "<option value=$row2[idseance]>$row2[nom] $row2[DateSeance]</option>";//  seances
            }
            echo "</select></td></tr>";


            mysqli_close($connect);
            ?>
            <tr>
                <td>	<input type="submit" value="Desinscrire"> </td>
            </tr>
            <tr>
                <td><input type="reset" value="Reset"></td>
            </tr>

        </table>

      </form>

      </div>
  </body>
</html>
