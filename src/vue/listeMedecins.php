<?php $titre = 'Médecins';
require_once(__DIR__.'/head.php'); ?>
<body>
  <?php
    require('header.html');
  ?>
  <h1>
    Liste des medecins du cabinet
  </h1>
  <ul id="liste">
    <?php
      foreach($medecins as $medecin) {
    ?>
      <li class="medecin"><?= $medecin->getPersonne()->getNom()?></li>
    <?php }?>
    </ul>
  <a href="../vue/pageAjoutMedecin.php"><p>Ajouter</p></a>
  <?php
    require('footer.html');
  ?>
</body>
</html>