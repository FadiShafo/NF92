<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Consultation éléve</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body style="background-image: url('background.png');background-repeat: no-repeat;background-size: cover;">
    <!-- Atout du menu -->
    <?php
      include "menu.php";
    ?>
    <div class="main">
      <h1><center>Consultater un élève </center></h1>
      <form action="consulter_eleve.php" method="POST">
        <table>
          <tr>
            <td> <p>Choisir un éléve:</p> </td>
          </tr>
          <tr>
            <?php
              // connexion
              include 'connexion.php';

              //requete
              $query = "SELECT * FROM eleves"; // recuperer la liste des eleves
              $result = mysqli_query($connect, $query);

              if (!$result) {
                echo "La requete $query a échoué : ".mysqli_error($connect);
                echo "<br><a href=\"consultation_eleve.php\" >Recommencer en cliquant ici</a>";
                exit();
              }

              echo "<td> <select name='ideleve' required>";

              while ($row = mysqli_fetch_array($result)) {
              echo "<option value= $row[0]> $row[1] $row[2] </option>";
              }

              echo "</select></td></tr>";

              mysqli_close($connect);
             ?>
          </tr>
          <tr>
            <td>	<input type="submit" value="Consulter"> </td>
          </tr>
          <tr>
            <td>  <input type="reset" value="Reset"></td>
          </tr>
        </table>
      </form>
    </div>
  </body>
</html>
