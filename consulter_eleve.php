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
      <?php
        // connexion
        include 'connexion.php';

        // recuperer id eleve
        $ideleve = $_POST['ideleve'];

        //Securite pour eviter l'injection SQL
        $ideleve_ech = mysqli_real_escape_string($connect,$ideleve);

        //test si le "required" de html n'a pas abouti
        if (empty($ideleve_ech)) {
          echo "Attenion, il faut remplir tous les champs";
          echo "<br><a href=\"consultation_eleve.php\" >Recommencer en cliquant ici</a>";
          exit();
        }

        //requete
        $query = "SELECT * FROM eleves WHERE eleves.ideleve = $ideleve_ech"; // recuperer les lignes (rows) de l'eleve choisie dans le formulaire
        $result = mysqli_query($connect, $query);

        if (!$result) {
          echo "La requete $query a échoué : ".mysqli_error($connect);
          echo "<br><a href=\"consultation_eleve.php\">Recommencer en cliquant ici</a>";
          exit();
        }

        while ($row = mysqli_fetch_array($result)) // definir les variables
        {
          $nom = $row['nom'];
          $prenom = $row['prenom'];
          $dateNaiss = $row['dateNaiss'];
          $dateInscription = $row['dateInscription'];
        }

        // determiner la date du jour
        date_default_timezone_set('Europe/Paris');
        $date = date("Y-m-d");

        //Deuxieme requete pour recuperer les informations des seances passé où l'eleves été inscrit par ordre croissant
        $query2 = "select inscription.idseance, inscription.ideleve, note, DateSeance, themes.nom, descriptif from inscription inner join seances on inscription.idseance = seances.idseance inner join themes on seances.idtheme = themes.idtheme where inscription.ideleve = $ideleve and seances.DateSeance <'$date' order by DateSeance";
        $result_query2 = mysqli_query($connect, $query2);
        if (!$result_query2) {
          echo "La requete $query2 a échoué : ".mysqli_error($connect);
          echo "<br><a href=\"consultation_eleve.php\">Recommencer en cliquant ici</a>";
          exit();
        }


        // Consultation des infos

        echo "<table align=center border=\"1\" cellpadding =\"10\">";
        echo "<tr><td><b>Dossier de $nom $prenom:</b></td></tr>";
        echo "<tr><td>Née le <b>$dateNaiss</b><br></td></tr>";
        echo "<tr><td>Inscrit le <b>$dateInscription</b> <br> <br></td></tr>";

        echo "<tr><td><b>Séances antérieures:</b></td></tr>";
        if (mysqli_num_rows($result_query2) == 0){ //  si eleve est inscrit à aucune seance
          echo "<<tr><td>Pas encore de seances pour cet élève</td></tr>";
        }
        else{
          while ($row2 = mysqli_fetch_array($result_query2))
          {

            echo "<tr><td>$row2[nom]</td>";
            echo "<td>$row2[DateSeance]</td>";
            echo "<td>$row2[descriptif]</td>";
            if ($row2['note']<0) //  si l'eleve a été noté
              {
                echo "<br><td>Pas encore noté</td></tr>";
              }
            else {
                echo "<td>$row2[note]</td></tr>";
              }
          }

        }
        echo "</table>";
        mysqli_close($connect);

       ?>

    </div>


  </body>
</html>
