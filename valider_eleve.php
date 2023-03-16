<!-- BUT : Verifier si l'eleve est deja inscrit (homonyme)
et confirmer l'inscription de l'eleve -->

<!DOCTYPE html>
<html lang="en" dir="ltr">
 <head>
   <meta charset="utf-8">
   <title></title>
   <link rel="stylesheet" href="style.css">
 </head>
 <body style="background-image: url('background.png');background-repeat: no-repeat;background-size: cover;">
   <!-- Atout du menu -->
     <?php
       include "menu.php";
     ?>
     <div class="main">

   <?php
     //connexion
     include 'connexion.php';
     date_default_timezone_set('Europe/Paris');
     $date = date("Y-m-d");


     // Récup de données
     $nom = $_POST["nom"];
     $prenom = $_POST["prenom"];
     $ddn = $_POST["ddn"];

     //test au cas ou le "required" de html n'aboutit pas
     if (empty($_POST["nom"]) or empty($_POST["prenom"]) or empty($_POST["ddn"])) {
       echo "Attenion, il faut remplir tous les champs";
       echo "<br><a href=\"ajout_eleve.php\">Recommencer en cliquant ici</a>";
       exit();
     }

     // Securite : pour eviter l'injection SQL
     $nom_ech = mysqli_real_escape_string($connect,$nom);
     $prenom_ech = mysqli_real_escape_string($connect,$prenom);
     $ddn_ech = mysqli_real_escape_string($connect,$ddn);

     // test nom et prenom depassent pas 30 char
     if (strlen($nom_ech)>30 or strlen($prenom_ech)>30) {
       echo "Attenion, les champs 'Nom' et 'Prenom'ne doivent pas depasser 30 characteres";
       echo "<br><a href=\"ajout_eleve.php\">Recommencer en cliquant ici</a>";
       exit();
       }

     // test age
     if ($ddn_ech>$date) {
       echo "Attenion, l'élève n'est pas encore née";
       echo "<br><a href=\"ajout_eleve.php\" >Recommencer en cliquant ici</a>";
       exit();
     }

     // test homonyme
     $query="select * from eleves where nom = '$nom_ech' and prenom = '$prenom_ech'";
     $result = mysqli_query($connect,$query);
     if (!$result) {
       echo "<p>Echec de la requete:".mysqli_error($connect);
       echo "<br><a href=\"ajout_eleve.php\" >Recommencer en cliquant ici</a>";
       exit();
     }

           if (!empty(mysqli_fetch_array($result))){
             echo "<p>Attenion, un éléve eponyme est déjà inscrit </p>";

           }


           echo "
             <p>Vous confirmer l'inscription de l'élève suivant?: <br><br> <b>M.me $nom_ech $prenom_ech né.e le $ddn_ech</b><br> <br><br>
             </p>
             <form class=\"formstyle\" action=\"ajouter_eleve.php\" method=\"post\">
               <input type=\"hidden\" name=\"nom\" value=\"$nom_ech\">
               <input type=\"hidden\" name=\"prenom\" value=\"$prenom_ech\">
               <input type=\"hidden\" name=\"ddn\" value=\"$ddn_ech\">
               <input type=\"submit\" value=\"Valider\">
             </form>

             <br>

             <form class=\"formstyle\" action=\"ajout_eleve.php\">
               <input type=\"submit\" value=\"Modifier\">
             </form>";
             exit();

           mysqli_close($connect);

   ?>

   </div>
 </body>
</html>
