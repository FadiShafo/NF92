<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Calendrier éléve</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body style="background-image: url('background.png');background-repeat: no-repeat;background-size: cover;">
    <!-- Atout du menu -->
      <?php
        include "menu.php";
      ?>
      <div class="main">
      <h1><center>Visualiser le calendrier d'un élève</center></h1>
      <form action="visualiser_calendrier_eleve.php" method="POST" >
        <table>
          <tr>
            <td> <p>Choisir un éléve:</p> </td>
          </tr>
          <tr>
            <?php
            // connexion
            include 'connexion.php';

            $query_eleves = "SELECT * FROM eleves";
            $result_eleves = mysqli_query($connect, $query_eleves);

            if (!$result_eleves) {
              echo "La requete $query_eleves a échoué : ".mysqli_error($connect);
              echo "<br><a href=\"visualisation_calendrier_eleve.php\" >Recommencer en cliquant ici</a>";
              exit();
            }

            echo "<td> <select name='ideleve' required>";

            while ($row = mysqli_fetch_array($result_eleves))
            {
            echo "<option value= $row[0]>$row[1] $row[2]</option>"; // option ideleve avec nom prenom
            }
            echo "</select></td>";
            echo "</tr>";

            mysqli_close($connect);
             ?>
             <tr>
               <td>	<input type="submit" value="Consulter"> </td>
             </tr>
             <tr>
               <td>  <input type="reset" value="Reset"></td>
             </tr>
      </div>
  </body>
</html>
