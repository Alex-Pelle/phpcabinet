<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Usagers</title>
</head>
<body>
  <?php
    require('header.html');
  ?>
  <h1>
    Liste des usagers du cabinet
  </h1>
  <ul id="liste">
    <?php
      foreach($usagers as $usager) {
    ?>
      <li class="usager"><?= $usager->getPersonne()->getNom()?></li>
    <?php }?>
    </ul>
  <a href="../vue/pageAjoutUsager.php"><p>Ajouter</p></a>
  <?php
    require('footer.html');
  ?>
</body>
</html>