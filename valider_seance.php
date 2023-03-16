<!-- Afficher la liste des seances avec un promopt (controles des saisies) des notes  -->

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
    <h1><center>Valider une séance </center></h1>
    <form  action="noter_eleves.php" method="post">
      <table>

            <?php
              include 'connexion.php';
              $idseance = $_POST['idseance'];

              // verifications
              //Securite pour eviter l'injection SQL
              $idseance_ech = mysqli_real_escape_string($connect,$idseance);

              //test si le "required" de html n'a pas abouti
              if (empty($idseance_ech)) {
                echo "Attenion, il faut remplir tous les champs";
                echo "<br><a href=\"validation_seance.php\" >Recommencer en cliquant ici</a>";
                exit();
              }

              //requete
              $query = "SELECT * FROM inscription INNER JOIN eleves on inscription.ideleve = eleves.ideleve where inscription.idseance='$idseance_ech'";
              $result = mysqli_query($connect,$query);

              //verif
              if (!$result) {
                echo "La requete $query a échoué :" .mysqli_error($connect);
                echo "<br><a href=\"inscription_eleve.php\" >Recommencer en cliquant ici</a>";
                exit();
              }

              // Verif si  pas d'eleve inscrits
              if (mysqli_num_rows($result) == 0) {
                echo "Il n'y a pas d'élèves inscrits dans cette séance";
                exit();
              }

              while ($ligne_eleves= mysqli_fetch_array($result)){
                echo "<tr><td><label>$ligne_eleves[nom] $ligne_eleves[prenom]</label></td>";
                echo "<td><input type ='hidden' name='seance' value=$idseance></td>";
                if ($ligne_eleves['note'] >=0 ){
                  $nbfautes = 40 - $ligne_eleves['note'];
                  echo "<td>Nombre de fautes enregistré précedement: <input type=number min=0 max=40 value='$nbfautes' name='$ligne_eleves[ideleve]'> </input></td></tr>";
                }
                else {
                  echo "<td>Nombre de fautes <input type=number min=0 max=40 name='$ligne_eleves[ideleve]'>  </input> </td></tr>";
                }
              }
              mysqli_close($connect);
             ?>


        <tr>
          <td><input type="submit" value="Envoyer"></td>
          <td><input type="reset" value="Reset"></td>
        </tr>

       </table>
    </form>

    </div>
  </body>
</html>
