<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inscription d'un élève à une séance</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body style="background-image: url('background.png');background-repeat: no-repeat;background-size: cover;">

    <!-- Atout du menu -->
      <?php
        include "menu.php";
      ?>
      <div class="main">

    <?php
      include 'connexion.php';
     ?>
     <h1><center>Inscrire un élève à une séance</center></h1>
     <form class="" action="inscrire_eleve.php" method="post">
       <table>
         <tr>
           <td><label for="eleve">Élève</label></td>
           <td>
             <select id=eleve name="ideleve">
              <?php
              $query = "SELECT * FROM eleves";
              $liste_eleves = mysqli_query($connect,$query);
              if (!$liste_eleves) {
                echo "La requete $query a échoué :" .mysqli_error($connect);
              exit();
              }

              foreach ($liste_eleves as $eleve) {
                echo "<option value = \"$eleve[ideleve]\"> $eleve[nom] $eleve[prenom]</option>";
              }
               ?>
             </select>
           </td>
         </tr>

         <tr>
           <td><label for="seances">Séance</label></td>
           <td><select id=seance name="idseance">
            <?php
            $query = "SELECT * FROM seances INNER JOIN themes ON seances.idtheme =themes.idtheme";
            $liste_seances = mysqli_query($connect,$query);
            if (!$liste_seances) {
              echo "La requete $query a échoué :" .mysqli_error($connect);
              exit();
            }

            foreach ($liste_seances as $seance) {
              echo "<option value = $seance[idseance]> Séance du $seance[DateSeance] sur le thème $seance[nom] </option>";
            }

            mysqli_close($connect);
             ?>
           </select></td>
         </tr>

         <tr>
           <td><input type="submit" value="Inscrire"></td>
         </tr>
         <tr>
          <td><input type="reset" value="Reset"></td>
         </tr>

       </table>

     </form>

    </div>
  </body>
</html>
