<?php $titre = 'Cabinet';
$css = 'accueil';
require_once(__DIR__.'/head.php'); ?>
<body>
  <?php
    require(__DIR__.'/header.php');
  ?>
  <h1 id="titre">Bienvenue sur le site de gestion du PHPCabinet!</h1>
  <div id="listes">
    <a href='/index.php?action=rdvs'><h2>Liste des <span class="no-wrap">rendez-vous</span></h2></a>
    <a href='/index.php?action=usagers'><h2>Liste des usagers</h2></a>
    <a href='/index.php?action=medecins'><h2>Liste des medecins</h2></a>
  </div>
  <?php
    require(__DIR__.'/footer.html');
  ?>
</body>
</html>