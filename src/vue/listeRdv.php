<?php $titre = 'Rendez-vous';
require_once(__DIR__.'/head.php'); ?>
<body>
  <?php
    require('header.php');
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