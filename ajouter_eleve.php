<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ajouter un élève</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body style="background-image: url('background.png');background-repeat: no-repeat;background-size: cover;">
    <!-- Atout du menu -->
      <?php
        include "menu.php";
      ?>
      <div class="main">

    <?php

    // Connexion
    include("connexion.php");

    // Determiner la date d'ajourd'hui
    date_default_timezone_set('Europe/Paris');
    $date_inscription = date("Y-m-d");

    //test au cas ou le "required" de html n'aboutit pas
    if (empty($_POST["nom"]) or empty($_POST["prenom"]) or empty($_POST["ddn"])) {
      echo "Attenion, il faut remplir tous les champs";
      echo "<br><a href=\"ajout_eleve.php\">Recommencer en cliquant ici</a>";
      exit();
    }


    // Récup de données
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $ddn = $_POST["ddn"];

    // Securite : pour eviter l'injection SQL
    $nom_ech = mysqli_real_escape_string($connect,$nom);
    $prenom_ech = mysqli_real_escape_string($connect,$prenom);
    $ddn_ech = mysqli_real_escape_string($connect,$ddn);


    // Constuire la requete d'ajout d'un eleve
    $query="INSERT INTO eleves VALUES(NULL,\"$nom_ech\",\"$prenom_ech\",\"$ddn_ech\",\"$date_inscription\")";

    // Executer la requete
    $result = mysqli_query($connect,$query);
    if (!$result) {
      echo "<p>Echec de la requete:".mysqli_error($connect);
      echo "<br><a href=\"ajout_eleve.php\" >Recommencer en cliquant ici</a>";
    }

    // Message de succés
    echo "<p>
    Félicitations ! Vous venez d'inscrire avec succès l'élève suivant: <br><br> <b>M.me $nom_ech $prenom_ech né.e le $ddn_ech</b><br> <br> Votre requête SQL: $query<br>
    </p>";
    exit;

    mysqli_close($connect);

     ?>


     </div>
  </body>
</html>
