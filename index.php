<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cabinet</title>
  <link rel="icon" type="image/x-icon" href="/favicon.ico">
</head>
<body>
  <?php
    require('vue/header.html');
  ?>
  <a href='controlleur/rdv.php'><h2>Liste des rendez-vous</h2></a>
  <a href='controlleur/usagers.php'><h2>Liste des usagers</h2></a>
  <a href='controlleur/medecins.php'><h2>Liste des medecins</h2></a>
  <?php
    include('vue/footer.html');
  ?>
</body>
</html>