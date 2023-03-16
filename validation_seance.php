<!-- Formulaire pour seletionner la seance que l'on souhaite valider-->

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Valider une séance</title>
    <link rel="stylesheet" href="style.css">

  </head>
  <body style="background-image: url('background.png');background-repeat: no-repeat;background-size: cover;">
    <!-- Atout du menu -->
      <?php
        include "menu.php";
      ?>
      <div class="main">
  <h1><center>Valider une séance</center></h1>
  <form action="valider_seance.php" method="POST" >
    <table>
     <tr>
     <td><p>Veuillez choisir la séance que vous souahitez valider:</p><br></td>
     </tr>

     <tr>
        <td>
        <select name="idseance">
         <?php
          date_default_timezone_set('Europe/Paris');
          $date = date("Y-m-d");
          include 'connexion.php';
          $query = "SELECT * FROM seances INNER JOIN themes WHERE themes.idtheme = seances.idtheme and seances.DateSeance < '$date'";
          $result_seances = mysqli_query($connect, $query);
          //verif
          if (!$result_seances) {
            echo "La requete $query a échoué :" .mysqli_error($connect);
            echo "<br><a href=\"validation_seance.php\" >Recommencer en cliquant ici</a>";
            exit();
          }

          while ($seance = mysqli_fetch_array($result_seances, MYSQLI_NUM)) {
            echo "<option value = \"$seance[0]\"> $seance[1] $seance[5]</option>";
          }

          mysqli_close($connect);
          ?>
       </select>
       </td>
     </tr>
     <tr>
       <td><input type="submit" value="Valider"></td>
     </tr>
     <tr>
       <td><input type="reset" value="Reset"></td>
     </tr>
   </table>

    </div>
  </body>
</html>
