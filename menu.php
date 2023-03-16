<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

      <?php
        function css_classes($page) {
          $classes='class="';
          if ($page==basename($_SERVER["SCRIPT_FILENAME"], '.php')) $classes.='active ';
          return $classes.'"';
        }
      ?>
      <ul class="menu">
        <li><center><h2>Menu</h2></center></li>
        <li><a href="accueil.php" <?= css_classes('accueil') ?>>Accueil</a></li>
  <br>
        <li><h4>Gestion des élèves</h4></li>
        <li><a href="ajout_eleve.php" <?= css_classes('ajout_eleve') ?>>Ajouter un élève</a></li>
        <li><a href="consultation_eleve.php" <?= css_classes('consultation_eleve') ?>>Consulter un élève</a></li>
        <li><a href="visualisation_calendrier_eleve.php" <?= css_classes('visualisation_calendrier_eleve') ?>>Visualiser calendrier éléve</a></li>
  <br>
        <li><h4>Gestion des thèmes</h4></li>
        <li><a href="ajout_theme.php" <?= css_classes('ajout_theme') ?>>Ajouter un thème</a></li>
        <li><a href="suppression_theme.php" <?= css_classes('suppression_theme') ?>>Supprimer un thème</a></li>
  <br>
        <li><h4>Gestion des séances</h4></li>
        <li><a href="ajout_seance.php" <?= css_classes('ajout_seance') ?>>Ajouter une séance</a></li>
        <li><a href="inscription_eleve.php" <?= css_classes('inscription_eleve') ?>>Inscrire un élève</a></li>
        <li><a href="desinscription_seance.php" <?= css_classes('desinscription_seance') ?>>Désinscrire un éléve</a></li>
        <li><a href="validation_seance.php" <?= css_classes('validation_seance') ?>>Valider une séance</a></li>





      </ul>
  </body>
  </html>
