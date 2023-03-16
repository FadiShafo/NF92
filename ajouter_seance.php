<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ajout d'une séance</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body style="background-image: url('background.png');background-repeat: no-repeat;background-size: cover;">
    <!-- Atout du menu -->
      <?php
        include "menu.php";
      ?>
      <div class="main">

      <h1><center>Ajout d'une séance</center></h1>
    <?php

      include 'connexion.php';
      $date= $_POST["date"];
      $theme= $_POST["theme"];
      $effmax= $_POST["effmax"];


      // verifications

      //test au cas ou le "required" de html n'aboutit pas
      if (empty($_POST["date"]) or empty($_POST["theme"]) or empty($_POST["effmax"])) {
        echo "Attenion, il faut remplir tous les champs";
        echo "<br><a href=\"ajout_seance.php\" >Recommencer en cliquant ici</a>";
        exit();
      }
      // Seances dans le futur
      date_default_timezone_set('Europe/Paris');
      $date_courante= date("Y-m-d");
      if ($date < $date_courante) {
        echo "<p> Vous ne pouvez pas créer une séance dans le passé </p>";
        exit();
      }

      // Seance sur le meme theme le meme jour
      //  Securite : pour eviter l'injection SQL
      $theme_ech = mysqli_real_escape_string($connect,$theme);
      $date_ech = mysqli_real_escape_string($connect,$date);
      $query = "SELECT * FROM seances WHERE idtheme =$theme AND DateSeance='$date'";

      $liste_seances = mysqli_query($connect,$query);

      if (!$liste_seances) {
        echo "La requete $query a échoué :" .mysqli_error($connect);
        exit();
      }


      if (mysqli_num_rows ($liste_seances) != 0) {
        echo "<p>il exite déjà une sénce sur ce thème</p>";
        exit ();
      }

      //  Verifier l'existence du theme
      $query_theme="select * from themes where idtheme = '$theme'";
      $result_theme = mysqli_query($connect,$query_theme);
      if (!$result_theme) {
        echo "<p>$query_theme a echoué:".mysqli_error($connect);
        echo "<br><a href=\"ajout_seance.php\" >Recommencer en cliquant ici</a>";
        exit();
      }
      if (empty(mysqli_fetch_array($result_theme))){
        echo "<p>Le theme n'existe pas </p>";
        exit();
      }


      // requete : ajouter la seance
      $effmax_ech =mysqli_real_escape_string ($connect, $effmax);
      $query = "INSERT INTO seances VALUES (NULL,\"$date_ech\", \"$effmax_ech\", \"$theme_ech\")";
      $result =mysqli_query ($connect, $query);

      if (!$result) {
        echo "Echec de la requete:".mysqli_error($connect);
      }
          else {
            // Message de succés
            echo "<p>
            Félicitations ! La séance a été correctement créée: <br>Votre requête SQL: $query
            </p>";
            exit;
          }
    mysqli_close($connect);

      // -- TODO :Autres verifications possibles que je n'ai pas eu le temps de developper
      // -- Il faut verifier l'adresse mail
      // -- verifier la date
      // -- Eff-max est positive
     ?>

     <a href=\"ajout_seance.php\" >Ajouter une autre séance</a>


   </div>
  </body>
</html>
