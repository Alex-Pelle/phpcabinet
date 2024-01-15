<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rendez-vous</title>
</head>
<body>
  <?php
    require('header.html');
  ?>
  <h1>
    Liste des rendez-vous du cabinet
  </h1>
  <div id="liste">
    <?php
      //TODO renvoyer des div avec la classe medecin
    ?>
  </div>
  <a href="../vue/pageAjoutRdv.php"><p>Ajouter</p></a>
  <?php
    require('footer.html');
  ?>
</body>
</html>