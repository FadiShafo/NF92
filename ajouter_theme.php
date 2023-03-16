<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ajouter un thème</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body style="background-image: url('background.png');background-repeat: no-repeat;background-size: cover;">
    <!-- Atout du menu -->
      <?php
        include "menu.php";
      ?>
      <div class="main">

      <h1><center>Ajout d'un thème</center></h1>
    <?php

      // Connexion
      include ("connexion.php");

      // Determiner la date d'ajourd'hui
      date_default_timezone_set('Europe/Paris');
      $date_inscription = date("Y-m-d");

      //test au cas ou le "required" de html n'aboutit pas
      if (empty($_POST["nom"]) or empty($_POST["desc"])) {
        echo "Attenion, il faut remplir tous les champs";
        echo "<br><a href=\"ajout_theme.php\" >Recommencer en cliquant ici</a>";
        exit();
      }

      //Verification nom ne depasse pas 30 char
      if (strlen($_POST["nom"])>30) {
        echo "Attention le nom doit etre inférieurs à 30 characteres.";
        echo "<br><a href=\"ajout_theme.php\" >Recommencer en cliquant ici</a>";
        exit();
      }

      // Récup de données
      $nom = $_POST["nom"];
      $desc = $_POST["desc"];


      // Securite : pour eviter l'injection SQL
      $nom_ech = mysqli_real_escape_string($connect,$nom);
      $desc_ech = mysqli_real_escape_string($connect,$desc);


      // test homonyme : test si ce thème exitse déja
       $query="select * from themes where nom = '$nom_ech' and supprime = '0' ";
       $result = mysqli_query($connect,$query);
       if (!$result) {
         echo "<p>Echec de la requete:".mysqli_error($connect);
         echo "<br><a href=\"ajout_eleve.php\" >Recommencer en cliquant ici</a>";
         exit();
       }

       if (!empty(mysqli_fetch_array($result))){
         echo "<p>Attenion, ce thème existe déjà </p>";
         exit();
       }

     // test homonyme
     $query_homonyme="select * from themes where nom = '$nom_ech' and descriptif = '$desc_ech'";
     $result_homonyme = mysqli_query($connect,$query_homonyme);
     if (!$result_homonyme) {
       echo "<p>Echec de la requete:".mysqli_error($connect);
       echo "<br><a href=\"ajout_eleve.php\" >Recommencer en cliquant ici</a>";
       exit();
     }

     if (!empty(mysqli_fetch_array($result_homonyme))){
       $query_reactivation = "update themes set supprime = '0' where themes.nom = '$nom'"; // reactivation de theme supprimé auparavant
       $result_reactivation = mysqli_query($connect, $query_reactivation);
       echo "<p>Un thème eponyme a été supprimé auparavant, il vient d'etre réactivé </p>";
       exit ();
       if (!$result_reactivation)
       {
         echo "<br>🚨 Attention, Erreur 🚨 ".mysqli_error($connect);
         echo "<br><a href=\"ajout_eleve.php\" >Recommencer en cliquant ici</a>";
         exit();
       }


     }
      // Constuire la requete d'ajout d'un eleve
      $query_theme="INSERT INTO themes VALUES(NULL,\"$nom_ech\",FALSE,\"$desc_ech\")";

      // Executer la requete
      $result_theme = mysqli_query($connect,$query_theme);
      if (!$result_theme) {
        echo "Echec de la requete:".mysqli_error($connect);
      }
          else {
            // Message de succés
            echo "<p>
            Félicitations ! Vous venez d'inscrire avec succès le thème suivant: <br><br> <b>$nom_ech avec la description: <br> $desc_ech </b><br> <br> Votre requête SQL: $query_theme<br>
            </p>";
            exit;
          }


      mysqli_close($connect);
       ?>

      </div>
    </body>
  </html>
