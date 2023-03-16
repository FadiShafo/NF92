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
      <h1><center>Inscrire un élève à une séance</center></h1>
      <div class="main">

    <?php
      include 'connexion.php';
      $idseance = $_POST['idseance'];
      $ideleve = $_POST['ideleve'];


      // verifications

      //Securite : pour eviter l'injection SQL
      $idseance_ech = mysqli_real_escape_string($connect,$idseance);
      $ideleve_ech = mysqli_real_escape_string($connect,$ideleve);

      //test au cas ou le "required" de html n'aboutit pas
      if (empty($_POST["idseance"]) or empty($_POST["ideleve"])) {
        echo "Attenion, il faut remplir tous les champs";
        echo "<br><a href=\"inscription_eleve.php\" >Recommencer en cliquant ici</a>";
        exit();
      }

      //requete
      $query = "INSERT INTO inscription VALUES (\"$idseance_ech\", \"$ideleve_ech\", -1)";
      $result = mysqli_query($connect,$query);

      //verif
      if (!$result) {
        if (mysqli_error($connect)=="Duplicate entry '$idseance_ech-$ideleve_ech' for key 'PRIMARY'"){
          echo "L'élève est déjà inscrit";
            exit();
        }
        else {

        echo "La requete $query a échoué :" .mysqli_error($connect);
        echo "<br><a href=\"inscription_eleve.php\" >Recommencer en cliquant ici</a>";
        exit();
      }
      }

      echo "<p>
      Félicitations ! Vous venez d'ajouter l'élève à la séance. :
      <br>Votre requête SQL: $query
      </p>";
      exit;
      mysqli_close($connect);
     ?>

   </div>
  </body>
</html>
