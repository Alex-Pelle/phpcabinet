<?php $titre = 'Cabinet';
require_once(__DIR__.'/head.php'); ?>
<body>
  <?php
    require(__DIR__.'/header.php');
  ?>
  <a href='/index.php?action=rdvs'><h2>Liste des rendez-vous</h2></a>
  <a href='/index.php?action=usagers'><h2>Liste des usagers</h2></a>
  <a href='/index.php?action=medecins'><h2>Liste des medecins</h2></a>
  <?php
    require(__DIR__.'/footer.html');
  ?>
</body>
</html>