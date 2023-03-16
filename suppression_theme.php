<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Suppression d'un thème</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body style="background-image: url('background.png');background-repeat: no-repeat;background-size: cover;">
    <!-- Atout du menu -->
      <?php
        include "menu.php";
      ?>
      <div class="main">
      <h1><center>Suppression d'un thème </center></h1>

      <form action="supprimer_theme.php" method="POST" >
        <table>
          <tr>
			       <td>Choisir le thème à supprimer:</td>
             <?php
             // connexion
             include 'connexion.php';

             //requete pour recuperer les themes
             $query = "SELECT * FROM themes WHERE supprime = 0"; // recuperer la liste des themes non supprimés
             $result = mysqli_query($connect, $query);

             if (!$result) {
               echo "La requete $query a échoué : ".mysqli_error($connect);
               echo "<br><a href=\"suppression_theme.php\" >Recommencer en cliquant ici</a>";
               exit();
             }


          	echo "<td><select name='idtheme' required>";
            while ($row = mysqli_fetch_array($result))
            {
              echo "<option value= $row[0]>$row[1]</option>";
            }

            echo "</select></td></tr>";


            mysqli_close($connect);


            ?>
            <tr>
                <td>	<input type="submit" value="Supprimer"> </td>
            </tr>
            <tr>
                <td><input type="reset" value="Reset"></td>
            </tr>

        </table>
      </form>


      </div>
  </body>
</html>
